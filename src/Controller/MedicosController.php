<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

/**
 * Medicos Controller
 *
 * @property \App\Model\Table\MedicosTable $Medicos
 * @property \App\Model\Table\HorariosTable $Horarios
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

$horarioDiurno = [

    "bloque1" => [
        "hora_inicio" => "8am",
        "hora_fin" => "9am",
        "status" => "true"
    ],
    "bloque2" => [
        "hora_inicio" => "9am",
        "hora_fin" => "10am",
        "status" => "true"
    ],

    "bloque3" => [
        "hora_inicio" => "10am",
        "hora_fin" => "11am",
        "status" => "true"
    ],
    "bloque4" => [
        "hora_inicio" => "11am",
        "hora_fin" => "12pm",
        "status" => "true"
    ],

    "bloque6" => [
        "hora_inicio" => "1pm",
        "hora_fin" => "2pm",
        "status" => "true"
    ],
    "bloque7" => [
        "hora_inicio" => "2pm",
        "hora_fin" => "3pm",
        "status" => "true"
    ],
    "bloque8" => [
        "hora_inicio" => "3pm",
        "hora_fin" => "4pm",
        "status" => "true"
    ],
    "bloque9" => [
        "hora_inicio" => "4pm",
        "hora_fin" => "5pm",
        "status" => "true"
    ],

];

$horarioNocturno = [

    "bloque10" => [
        "hora_inicio" => "5pm",
        "hora_fin" => "6pm",
        "status" => "true"
    ],
    "bloque11" => [
        "hora_inicio" => "6pm",
        "hora_fin" => "7pm",
        "status" => "true"
    ],

    "bloque12" => [
        "hora_inicio" => "7pm",
        "hora_fin" => "8pm",
        "status" => "true"
    ],
    "bloque13" => [
        "hora_inicio" => "8pm",
        "hora_fin" => "9pm",
        "status" => "true"
    ],

    "bloque14" => [
        "hora_inicio" => "9pm",
        "hora_fin" => "10pm",
        "status" => "true"
    ],
    "bloque15" => [
        "hora_inicio" => "10pm",
        "hora_fin" => "11pm",
        "status" => "true"
    ],
    "bloque16" => [
        "hora_inicio" => "11pm",
        "hora_fin" => "12am",
        "status" => "true"
    ],
    "bloque17" => [
        "hora_inicio" => "12am",
        "hora_fin" => "1am",
        "status" => "true"
    ],
    "bloque18" => [
        "hora_inicio" => "1am",
        "hora_fin" => "2am",
        "status" => "true"
    ],

];

Configure::write('horarioDiurno', $horarioDiurno);
Configure::write('horarioNocturno', $horarioNocturno);

$semana = [
    "Lunes",
    "Martes",
    "Miercoles",
    "Jueves",
    "Viernes",
    "Sabado",
    "Domingo",
];

Configure::write('semana', $semana);

class MedicosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function isAuthorized($user)
    {
        // Verificar el rol del usuario
        if ($user['rol'] == 2) {
            // Permitir acceso solo a los métodos login, logout e index
            if (in_array($this->request->getParam('action'), ['searchMedico'])) {
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

    public function searchMedico()
    {
        $this->viewBuilder()->Setlayout('medicos');

        $this->loadModel('Especialidades');
        $especialidadesDescripciones = $this->Especialidades->find('all')->toArray();
        $this->set(compact('especialidadesDescripciones'));

        $this->loadModel('Medicos');
        $medicos = $this->Medicos
        ->find('all')
        ->where(['status'=>'activo'])
        ->toArray();
        $this->set(compact('medicos'));
    }

    public function index()
    {

        $this->viewBuilder()->Setlayout('medicos');

        $this->paginate = [
            'limit' => 5,
        ];

        $searchTerm = $this->request->getQuery('search');
        $filterStatus = $this->request->getQuery('status');
        $filterEspecialidad = $this->request->getQuery('especialidad');
        
        if (empty($searchTerm) && empty($filterStatus) && empty($filterEspecialidad)) {
            $medicos = 'null';
        } else {
            // Condición de búsqueda si se envia un término por search
            if (!empty($searchTerm)) {

                $this->paginate = [
                    'conditions' => [
                        'OR' => [
                            'Medicos.nombre_doctor' => $searchTerm,
                            'Medicos.codigo_doc' => $searchTerm,
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

            if (!empty($filterEspecialidad)) {
                $this->paginate['conditions'] = [
                    'especialidad_id LIKE' => $filterEspecialidad
                ];
            }

            $medicos = $this->paginate(
                $this->Medicos->find('all')
                    ->contain('Especialidades')
            );

        }

        $this->set(compact('medicos'));

        $cantidadMedicos = $this->Medicos->find('all')->count();
        $this->set(compact('cantidadMedicos'));

        $this->loadModel('Especialidades');
        $especialidadesDescripciones = $this->Especialidades->find('all')->toArray();
        $this->set(compact('especialidadesDescripciones'));



    }

    /**
     * View method
     *
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Especialidades');
        $this->viewBuilder()->Setlayout('medicos');
        // $medico = $this->Medicos->get($id, [
        //     'contain' => ['Medicos'],
        // ]);
        $medico = $this->Medicos->get($id);  
        
        $especialidad = $this->Especialidades->get($medico->especialidad_id);

        
        $this->set('medico', $medico);
        $this->set('especialidad', $especialidad);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        // debug($horarioDiurno);
        // debug($horarioNocturno);
        // debug(json_decode($horarioDiurno));
        // debug(json_decode($horarioNocturno));
        // die;
        $this->viewBuilder()->Setlayout('medicos');
        $medico = $this->Medicos->newEmptyEntity();

        $bloqueDiurno = Configure::read('horarioDiurno');
        $this->set(compact('bloqueDiurno'));
        $bloqueNocturno = Configure::read('horarioNocturno');
        $this->set(compact('bloqueNocturno'));

        if ($this->request->is('post')) {
            $this->LoadModel('Horarios');
            if ($this->request->getData()['codigo_doc']) {
                $existingCode = $this->Medicos->find('all', [
                    'conditions' => ['codigo_doc' => $this->request->getData()['codigo_doc']],
                ])->first();

                if ($existingCode) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../Medicos/add',
                        'mensaje' => 'El codigo ya se encuentra utilizado. Porfavor, ingresa otro nombre de codigo de doctor.'
                    ];

                    $url = [
                        'controller' => 'medicos',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }
            }


            $medico = $this->Medicos->patchEntity($medico, $this->request->getData());

            $medicoGuardado = $this->Medicos->save($medico);
            if ($medicoGuardado) {

                $dataIngresada = $this->request->getData();
                $diasLaborales = $dataIngresada['dias'];
                unset($dataIngresada['dias']);

                $verifyHorarios = $this->Horarios->find('all', [
                    'conditions' => ['medicoid' => 10],
                ]);

                $horarioDiurno = json_encode(Configure::read('horarioDiurno'));
                $horarioNocturno = json_encode(Configure::read('horarioNocturno'));
                $semanas = Configure::read('semana');

                if ($this->request->getData()['horario'] == 'diurno') {
                    $horarioTrabajo = $horarioDiurno;
                } elseif ($this->request->getData()['horario'] == 'nocturno') {
                    $horarioTrabajo = $horarioNocturno;
                }

                foreach ($semanas as $semana) {
                    $newHorario = $this->Horarios->newEmptyEntity();
                    $newHorario->hora = $horarioTrabajo;
                    $newHorario->medicoid = $medicoGuardado->medico_id;
                    $newHorario->dia_semana = $semana;
                    if (in_array($semana, $diasLaborales)) {
                        $newHorario->estado = 'Disponible';
                    } else {
                        $newHorario->estado = 'Desactivado';
                    }

                    if (!($this->Horarios->save($newHorario))) {
                        $respuesta = "Error";
                        $data = [
                            'respuesta' => $respuesta,
                            'link' => '../Medicos',
                            'mensaje' => 'Los horarios no se pudieron crear. '
                        ];

                        $url = [
                            'controller' => 'medicos',
                            'action' => 'alert',
                            '?' => $data
                        ];
                        return $this->redirect($url);
                    }
                }

                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../Medicos',
                    'mensaje' => 'El Medico ha sido creado exitosamente.'
                ];

                $url = [
                    'controller' => 'medicos',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../Medicos',
                'mensaje' => 'El Medico no se pudo crear. Porfavor, trata denuevo. '
            ];

            $url = [
                'controller' => 'medicos',
                'action' => 'alert',
                '?' => $data
            ];
            return $this->redirect($url);

            // if ($this->Medicos->save($medico)) {
            //     // $this->Flash->success(__('The medico has been saved.'));

            //     return $this->redirect(['action' => 'index']);
            // }
            // // $this->Flash->error(__('The medico could not be saved. Please, try again.'));
        }
        $this->loadModel('Especialidades');
        $especialidadesDescripciones = $this->Especialidades->find('all')->toArray();

        $this->set(compact('especialidadesDescripciones'));
        $this->set(compact('medico'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->Setlayout('medicos');

        $medico = $this->Medicos->get($id);
        $this->LoadModel('Horarios');
        $this->LoadModel('Citas');

        $citas = $this->Citas
            ->find()
            ->where(['idMedico' => $id, 'fecha >=' => date('m/d/y, h:i a'), 'status' => 'pendiente']);
        $this->set(compact('citas'));

        $horarios = $this->Horarios
        ->find()
        ->where(['medicoid' => $id]);
  
        $this->set(compact('horarios'));

        $estado = "Disponible";
        $this->set(compact('estado'));

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->LoadModel('Horarios');
            $dataIngresada = $this->request->getData();

            if (isset($dataIngresada['horario'])) {

                if (!empty($citas->toArray())) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../medicos',
                        'mensaje' => 'El Medico tiene cita pendientes no puede actualizar horario.'
                    ];

                    $url = [
                        'controller' => 'medicos',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }

                $diasLaborales = $dataIngresada['dias'];
                unset($dataIngresada['dias']);

                $verifyHorarios = $this->Horarios->find('all', [
                    'conditions' => ['medicoid' => $id],
                ]);

                $horarioDiurno = json_encode(Configure::read('horarioDiurno'));
                $horarioNocturno = json_encode(Configure::read('horarioNocturno'));

                if ($this->request->getData()['horario'] == 'diurno') {
                    $horarioTrabajo = $horarioDiurno;
                } elseif ($this->request->getData()['horario'] == 'nocturno') {
                    $horarioTrabajo = $horarioNocturno;
                }

                foreach ($verifyHorarios->toArray() as $horarioActuales) {
                    $medicoNewData = $this->Horarios->get($horarioActuales->id);
                    if (in_array($medicoNewData->dia_semana, $diasLaborales)) {
                        $medicoNewData->hora = $horarioTrabajo;
                        $medicoNewData->estado = 'Disponible';
                    } else {
                        $medicoNewData->hora = $horarioTrabajo;
                        $medicoNewData->estado = 'Desactivado';
                    }
                    
                    if (!($this->Horarios->save($medicoNewData))) {
                        $respuesta = "Error";
                        $data = [
                            'respuesta' => $respuesta,
                            'link' => '../medicos',
                            'mensaje' => 'Los horarios no se pudieron actualizar. '
                        ];

                        $url = [
                            'controller' => 'medicos',
                            'action' => 'alert',
                            '?' => $data
                        ];
                        return $this->redirect($url);
                    }
                }    

            }

            if ($this->request->getData()['codigo_doc'] !=  $medico->codigo_doc) {
                if ($this->request->getData()['codigo_doc']) {
                    $existingCode = $this->Medicos->find('all', [
                        'conditions' => ['codigo_doc' => $this->request->getData()['codigo_doc']],
                    ])->first();

                    if ($existingCode) {
                        $respuesta = "Error";
                        $data = [
                            'respuesta' => $respuesta,
                            'link' => '../Medicos/edit/'.$id,
                            'mensaje' => 'El codigo ya se encuentra utilizado. Porfavor, ingresa otro nombre de codigo de doctor.'
                        ];

                        $url = [
                            'controller' => 'medicos',
                            'action' => 'alert',
                            '?' => $data
                        ];

                        return $this->redirect($url);
                    }
                }
            }
            $medico = $this->Medicos->patchEntity($medico, $this->request->getData());
            if ($this->Medicos->save($medico)) {
                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../Medicos',
                    'mensaje' => 'El Medico ha sido editado exitosamente.'
                ];

                $url = [
                    'controller' => 'medicos',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../Medicos',
                'mensaje' => 'El Medico no se pudo editar. Porfavor, trata denuevo. '
            ];

            $url = [
                'controller' => 'medicos',
                'action' => 'alert',
                '?' => $data
            ];
            return $this->redirect($url);
        }

        $this->loadModel('Especialidades');
        $especialidadesDescripciones = $this->Especialidades->find('all')->toArray();
        // debug($especialidadesDescripciones);
        // die;
        $this->set(compact('especialidadesDescripciones'));
        $this->set(compact('medico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->LoadModel('Horarios');
        $this->request->allowMethod(['post', 'delete']);
        $medico = $this->Medicos->get($id);

        $this->Horarios->deleteAll(array('medicoid' => $medico->medico_id));

        if ($this->Medicos->delete($medico)) {

            $respuesta = "Correcto";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../Medicos',
                'mensaje' => 'El Medico ha sido eliminado exitosamente'
            ];

            $url = [
                'controller' => 'medicos',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);

            //    $respuesta = "Correcto";
            //    return $this->redirect(['action' => 'alert', 'respuesta' => $respuesta ,'link' => '../medicos','mensaje'=>'The medico has been deleted.']);
        } else {
            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../Medicos',
                'mensaje' => 'El Medico no se pudo eliminar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'medicos',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);

            // $respuesta = "Error";
            // return $this->redirect(['action' => 'alert', 'respuesta' => $respuesta, 'link' => '../medicos', 'mensaje' => 'The medico could not be deleted. Please, try again.']);
        }
    }

    public function alert()
    {
        // $data = $this->getRequest();
        // debug($data);
        // die;
        $this->viewBuilder()->Setlayout('alert');
        $request = $this->getRequest();
        $respuesta = $request->getQuery('respuesta');
        $link = $request->getQuery('link');
        $mensaje = $request->getQuery('mensaje');

        $this->set(compact('respuesta'));
        $this->set(compact('link'));
        $this->set(compact('mensaje'));
    }
}