<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\AfiliadosTable $Afiliados
 * @property \App\Model\Table\MedicosTable $Medicos
 * @property \App\Model\Table\HorariosTable $Horarios
 * @property \App\Model\Table\CitasTable $Citas 
 * @property \App\Model\Table\AfiliadosTable $searchAfiliados
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->Auth->allow(['login', 'logout']);
    }

    public function isAuthorized($user)
    {

        if ($user['status'] == "inactivo") {
            $this->set('swalMessage', 'Este usuario se encuentra inactivo, contacte con soporte');
            $this->set('swalType', 'warning');
            $this->viewBuilder()->Setlayout('error');
            $this->render('/element/error');
            return false;
        }

        if ($user['rol'] == 2) {

            // Permitir acceso solo a los métodos login, logout e index
            if (in_array($this->request->getParam('action'), ['login', 'eliminarAfiliado', 'logout', 'ajustes', 'afiliados', 'agendarcita', 'searchAfiliados', 'citas'])) {
                return true;
            }

            // Bloquear acceso al método users/add
            if (
                $this->request->getParam('action') === 'add' || $this->request->getParam('action') === 'delete' || $this->request->getParam('action') === 'edit'
                || $this->request->getParam('action') === 'view' || $this->request->getParam('action') === 'index'
            ) {
                return false;
            }
        }

        // Permitir acceso por defecto para otros roles
        return true;
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $user = $this->Auth->user();

        if ($user) {

            if ($user['status'] == "inactivo") {
                $this->set('swalMessage', 'Este usuario se encuentra inactivo, contacte con soporte');
                $this->set('swalType', 'warning');
                $this->viewBuilder()->Setlayout('error');
                $this->render('/element/error');
            } else {
                if ($user['rol'] === '1') {
                    $this->Auth->allow();
                } else {

                    if (!$this->isAuthorized($user)) {
                        $this->set('swalMessage', 'Estas intentando acceder a algo fuera de tus permisos, seras deslogeado');
                        $this->set('swalType', 'warning');
                        $this->viewBuilder()->Setlayout('error');
                        $this->render('/element/error');
                    }
                }
            }
        }
    }

    public function login()
    {
        $this->viewBuilder()->Setlayout('login');
        $this->set('mensaje', 'noPost');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                
                $updateConectionUser = $this->Users->get($user['id']);
                $updateConectionUser->ultima_conexion = date('m/d/y, h:i a');

                if ($this->Users->save($updateConectionUser)) {
                    $this->Auth->setUser($user);
                    return $this->redirect(['controller' => 'Pages', 'action' => 'dashboard']);
                }
            }
            $this->set('mensaje', 'error1');
        }

    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $this->viewBuilder()->Setlayout('medicos');

        $this->paginate = [
            'limit' => 5,
        ];

        $searchTerm = $this->request->getQuery('search');
        $filterStatus = $this->request->getQuery('status');

        if (empty($searchTerm) && empty($filterStatus)) {
            $users = 'null';
        } else {
            // Condición de búsqueda si se envia un término por search
            if (!empty($searchTerm)) {

                $this->paginate = [
                    'conditions' => [
                        'OR' => [
                            'Users.email' => $searchTerm,
                            'Users.user' => $searchTerm,
                        ],
                    ],
                ];
            }

            // Condición de búsqueda si se envia un término el status
            if (!empty($filterStatus)) {
                $this->paginate['conditions'] = [
                    'status LIKE' => $filterStatus
                ];
            }
            $users = $this->paginate($this->Users);
        }

        $cantidadUsers = $this->Users->find('all')->count();

        $this->set(compact('cantidadUsers'));
        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($this->request->getData()['user']) {
                $existingUser = $this->Users->find('all', [
                    'conditions' => ['user' => $this->request->getData()['user']],
                ])->first();

                if ($existingUser) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../users/add',
                        'mensaje' => 'El usuario ya se encuentra registrado. Porfavor, ingresa otro nombre de usuario.'
                    ];

                    $url = [
                        'controller' => 'users',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }

                $existingUser = $this->Users->find('all', [
                    'conditions' => ['email' => $this->request->getData()['email']],
                ])->first();

                if ($existingUser) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../users/add',
                        'mensaje' => 'El correo ya se encuentra registrado. Porfavor, ingresa otro correo.'
                    ];

                    $url = [
                        'controller' => 'users',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users',
                    'mensaje' => 'El usuario ha sido agregado exitosamente'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            } else {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users',
                    'mensaje' => 'El usuario no se pudo agreagar. Porfavor, trata denuevo.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->email = $this->request->getData()['email'];

            if ($this->Users->save($user)) {

                $respuesta = "Correcto";

                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users',
                    'mensaje' => 'El usuario ha sido editado exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario no se pudo editar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }

        $this->set(compact('user'));
    }
    public function alert()
    {
        $this->viewBuilder()->Setlayout('alert');
        $request = $this->getRequest();
        $respuesta = $request->getQuery('respuesta');
        $link = $request->getQuery('link');
        $mensaje = $request->getQuery('mensaje');

        $this->set(compact('respuesta'));
        $this->set(compact('link'));
        $this->set(compact('mensaje'));
    }

    public function ajustes()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Auth->user();
        $the_user = $user['id'];
        $the_user_rol = $user['rol'];

        $this->set(compact('the_user', 'the_user_rol'));
        // $user = $this->Users->get($id);
        // $this->set(compact('user'));
    }

    public function actualizacion()
    {
        $this->viewBuilder()->Setlayout('actualizacion');
    }

    public function agendarcita($id)
    {
        $this->loadModel("Afiliados");
        $this->loadModel("Horarios");
        $this->loadModel("Citas");

        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Auth->user();
        $this->set(compact('id'));
        $afiliados = $this->Afiliados->find('all', [
            'conditions' => ['idUser' => $user['id']],
        ]);
        $this->set(compact('afiliados'));

        // $horarios = $this->Horarios->find('all', [
        //     'conditions' => ['medicoid' => $id],
        // ]);

        $horarios = $this->Horarios
            ->find()
            ->where(['medicoid' => $id, 'estado' => 'Disponible']);

        $this->set(compact('horarios'));

        $citas = $this->Citas
            ->find()
            ->where(['idMedico' => $id, 'fecha >' => date('m/d/y, h:i a'), 'status' => 'pendiente']);
        $this->set(compact('citas'));

        if ($this->request->is('post')) {

            $array = explode("/", $this->request->getData()['bloque']);

            // Obtener el primer elemento del array
            $bloqueNombre = $array[0];

            // Obtener el segundo elemento del array
            $diaNombre = $array[1];


            $horariosNew = $this->Horarios
                ->find()
                ->where(['medicoid' => $id, 'dia_semana' => $diaNombre, 'estado' => 'Disponible'])
                ->first()->toArray();

            $idHorario = $horariosNew['id'];
            $bloques = json_decode($horariosNew['hora'], true);

            // foreach ($bloques as $key => $bloque) {

            //     if ($key == $bloqueNombre) {
            //         $bloques[$bloqueNombre]['status'] = 'false';
            //         break;
            //     }
            // }

            // $Newbloques = json_encode($bloques);

            // $newData = $this->Horarios->get(intval($idHorario));
            // $newData->hora = $Newbloques;
            // $this->Horarios->save($newData);

            $this->LoadModel('Citas');
            $newCita = $this->Citas->newEmptyEntity();
            $newCita->user_id = $this->Auth->user('id');
            $newCita->description = $this->request->getData()['descripcion'];
            $newCita->idMedico = $this->request->getData()['medicoid'];
            $newCita->dia_semana = $diaNombre;
            $newCita->bloque_hora = $bloqueNombre;
            $newCita->fecha = $this->request->getData()['fecha'];

            if ($this->request->getData()['afiliado'] == 'yo') {
                $newCita->idafiliado = null;
            } else {
                $newCita->idafiliado = $this->request->getData()['afiliado'];
            }

            if ($this->Citas->save($newCita)) {

                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../Medicos/searchMedico',
                    'mensaje' => 'Cita agendada exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);

            } else {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../Medicos/searchMedico',
                    'mensaje' => 'La cita no se ha podido agendar, intente denuevo.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }
            // debug($newCita);
            // debug($newData);
            // debug($this->request->getData());
            // die;
        }
    }

    public function verHistorialCitasSistema()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $this->loadModel("Afiliados");
        $this->loadModel("Medicos");
        $this->loadModel("Citas");

        $user = $this->Auth->user();
        // $currentUser = $this->Users
        // ->find()
        // ->where(['id' => $user['id']])->first()->toArray();


        $filterCorreo = $this->request->getQuery('search');
        $citas = 'null';
        $afiliados = 'null';
        $medicos = 'null';
        if (!empty($filterCorreo)) {

            $currentUser = $this->Users->find('all', [
                'conditions' => ['email' => $filterCorreo],
            ])->toArray();


            if (empty($currentUser)) {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/verHistorialCitasSistema',
                    'mensaje' => 'El correo o nombre que ingreso no existe'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $citas = $this->Citas
                ->find()
                ->where(['user_id' => $currentUser[0]['id'], 'fecha >' => date('m/d/y, h:i a')]);

            $medicos = $this->Medicos
                ->find()
                ->where(['status' => 'activo'])
                ->contain('Especialidades')->toArray();

            if (!empty($citas->toArray())) {
                $afiliados = $this->Afiliados->find('all', [
                    'conditions' => ['idUser' => $currentUser[0]['id']],
                ])->toArray();
            }
            $currentUser = $currentUser[0];
            $this->set(compact('currentUser'));
        }
        $this->set(compact('medicos'));
        $this->set(compact('citas'));
        $this->set(compact('afiliados'));
    }
    public function afiliados()
    {
        $this->loadModel("Afiliados");
        $this->viewBuilder()->Setlayout('medicos');
        $afiliado = $this->Afiliados->newEmptyEntity();
        $this->set(compact('afiliado'));

        if ($this->request->is('post')) {

            if ($this->request->getData()['cedula']) {
                $existingUser = $this->Afiliados->find('all', [
                    'conditions' => ['cedula' => $this->request->getData()['tipo'] . '-' . $this->request->getData()['cedula']],
                ])->first();

                if ($existingUser) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../users/afiliados',
                        'mensaje' => 'El afiliado ya se encuentra registrado. Porfavor, ingresa otra cedula de afiliado.'
                    ];

                    $url = [
                        'controller' => 'users',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }
            }

            $afiliados = $this->Afiliados->patchEntity($afiliado, $this->request->getData());
            $afiliados->cedula = $this->request->getData()['tipo'] . '-' . $afiliados->cedula;

            if ($this->Afiliados->save($afiliados)) {
                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../dashboard',
                    'mensaje' => 'El usuario ha sido agregado exitosamente'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            } else {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/afiliados',
                    'mensaje' => 'El afiliado no se pudo agregar. Porfavor, trata denuevo.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }
        }
        $user = $this->Auth->user();
        $afiliado->idUser = $user['id'];
        $this->set(compact('afiliado'));
    }

    public function searchAfiliados($the_user, $the_user_rol)
    {
        $this->loadModel("Afiliados");
        $this->viewBuilder()->setLayout('medicos');

        $user = $this->Auth->user();
        $idUser = $the_user;

        $afiliados = $this->Afiliados->find()
            ->where(['idUser' => $idUser])
            ->toArray();

        $afiliadosArray = [];
        foreach ($afiliados as $afiliado) {
            $afiliadosArray[] = [
                'id' => $afiliado->id,
                'nombre' => $afiliado->nombre,
                'apellido' => $afiliado->apellido,
                'fecha_nacimiento' => $afiliado->fecha_nacimiento,
                'cedula' => $afiliado->cedula,
                'email' => $afiliado->email

                // Agrega aquí los campos que quieras incluir en el array
            ];

        }

        $this->set(compact('afiliadosArray', 'the_user_rol'));
    }

    public function eliminarAfiliado($id_afi = null)
    {
        $this->loadModel("Afiliados");

        $this->request->allowMethod(['get', 'post', 'put', 'delete']);

        $afiliado = $this->Afiliados->get($id_afi);

        //concatenar los valores necesarios
        $user = $this->Auth->user();
        $the_user = $user['id'];
        $the_user_rol = $user['rol'];


        if ($this->Afiliados->delete($afiliado)) {

            $respuesta = "Correcto";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users/searchAfiliados/' . $the_user . '/' . $the_user_rol,
                'mensaje' => 'El Afiliado ha sido eliminado exitosamente'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);

        } else {
            $respuesta = "Error";
            $data = [

                'respuesta' => $respuesta,
                'link' => '../users/searchAfiliados/' . $the_user . '/' . $the_user_rol,
                'mensaje' => 'El Afiliado no se pudo eliminar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);

        }

    }

    public function delete($id = null)
    {
        $this->loadModel('Afiliados');
        $this->loadModel('Citas');
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Citas->deleteAll(array('user_id' => $user->id));
        $this->Afiliados->deleteAll(array('idUser' => $user->id));


        if ($this->Users->delete($user)) {
            $respuesta = "Correcto";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario ha sido eliminado exitosamente'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        } else {
            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario no se pudo eliminar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }
    }

    public function editprofile()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $the_user = $this->Auth->user();
        $id = $the_user['id'];
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->email = $this->request->getData()['email'];

            if ($this->Users->save($user)) {

                $respuesta = "Correcto";

                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../dashboard',
                    'mensaje' => 'El usuario ha sido editado exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users/editprofile',
                'mensaje' => 'El usuario no se pudo editar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }

        $this->set(compact('user'));
    }

    public function cambiarStatusCitas()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $this->loadModel('Citas');

        $request = $this->getRequest();
        $status = $request->getQuery('status');
        $id = $request->getQuery('id');
        $cita = $this->Citas->get($id);
        $cita->status = $status;

        if ($this->Citas->save($cita)) {

            $respuesta = "Correcto";

            $data = [
                'respuesta' => $respuesta,
                'link' => '../users/verHistorialCitasSistema',
                'mensaje' => 'El estado de la cita se ha actualizado exitosamente.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }

        $respuesta = "Error";
        $data = [
            'respuesta' => $respuesta,
            'link' => '../users/verHistorialCitasSistema',
            'mensaje' => 'La cita no se pudo actualizar. Porfavor, trata denuevo.'
        ];

        $url = [
            'controller' => 'users',
            'action' => 'alert',
            '?' => $data
        ];

        return $this->redirect($url);
    }

    public function editAfiliado($id)
    {
        $this->viewBuilder()->Setlayout('medicos');
        $this->loadModel("Afiliados");
        $afiliado = $this->Afiliados->get($id);
        $this->set(compact('afiliado'));
        // debug($afiliado);
        // die;

        if ($this->request->is('post')) {
            $afiliado = $this->Afiliados->patchEntity($afiliado, $this->request->getData());
            $afiliado->cedula = $this->request->getData()['tipo'] . '-' . $afiliado->cedula;

            if ($this->Afiliados->save($afiliado)) {
                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/editAfiliado/' . $id,
                    'mensaje' => 'El afiliado ha sido actualizado exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            } else {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/editAfiliado/' . $id,
                    'mensaje' => 'El afiliado no se pudo agregar. Porfavor, trata denuevo.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }
        }

    }

    public function citas()
    {
        $this->viewBuilder()->setLayout('medicos'); // Barra de navegación.

        $this->loadModel("Afiliados");
        $this->loadModel("Horarios");
        $this->loadModel("Citas");
        $this->loadModel("Medicos");
        $this->loadModel('Especialidades');

        $user = $this->Auth->user();
        $id = $user['id'];
        $this->set(compact('id'));
        $afiliados = $this->Afiliados->find('all', [
            'conditions' => ['idUser' => $user['id']],
        ]);
        $this->set(compact('afiliados'));

        $user = $this->Users->get($id)->toArray();
        $this->set(compact('user'));

        $citas = $this->Citas
            ->find()
            ->where(['user_id' => $id])
            ->toArray();

        $medicos = $this->Medicos
            ->find('all')
            ->contain('Especialidades')
            ->toArray();

        $this->set(compact('medicos'));

        $afiliados = $this->Afiliados->find('all', [
            'conditions' => ['idUser' => $user['id']],

        ])->toArray();
        $this->set(compact('afiliados'));


        // debug($medicos);
        // debug($afiliados);
        // debug($citas);
        // die;

        // $selectedId = $this->request->getData('afiliado'); // Asegúrate de que el campo en tu formulario se llame "afiliado" y utiliza getData para obtener el valor seleccionad

        $citas = $this->Citas->find()
            ->where(['user_id' => $id])
            ->toArray();
        $this->set(compact('citas'));

        $citasArray = [];
        foreach ($citas as $la_cita) {
            $citasArray[] = [
                'id' => $la_cita->id,
                'user_id' => $la_cita->user_id,
                'dia_semana' => $la_cita->dia_semana,
                'description' => $la_cita->description,
                'fecha' => $la_cita->fecha,
                'created' => $la_cita->created,
                'modified' => $la_cita->modified,
                'idMedico' => $la_cita->idMedico,
                'idafiliado' => $la_cita->idafiliado,
                'bloque_hora' => $la_cita->bloque_hora,
                'status' => $la_cita->status,
            ];

            // Obtener información de los horarios
            $horarios = $this->Horarios->find()
                ->where(['medicoid' => $la_cita->idMedico])
                ->toArray();
            $citasArray[count($citasArray) - 1]['horarios'] = $horarios;

            // Obtener información del médico
            $medico = $this->Medicos->find()
                ->where(['medico_id' => $la_cita->idMedico])
                ->first(); // Supongo que obtienes un único médico por cita
            $citasArray[count($citasArray) - 1]['medico'] = $medico;
        }
        $this->set(compact('citasArray'));
    }

}