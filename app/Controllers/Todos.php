<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
class Todos extends RestController
{
  protected $modelName = 'App\Models\TodosModel';
	protected $format = 'json';

	public function index(){
    $todos = $this->model->findAll();
		return $this->respond($todos);
	}

	public function create(){
		helper(['form']);

		$rules = [
			'title' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$data = [
				'title' => $this->request->getVar('title'),
				'description' => $this->request->getVar('description'),
				'completed' => $this->request->getVar('completed')
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
			return $this->respondCreated($data);
		}
	}

	public function show($id = null){
		$data = $this->model->find($id);
		return $this->respond($data);
	}

	public function update($id = null){
		helper(['form', 'array']);

		$rules = [
			'title' => 'required',
			// 'completed' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$data = [
				'id' => $id,
				'title' => $this->request->getVar('title'),
				'description' => $this->request->getVar('description'),
				'completed' => $this->request->getVar('completed')
			];

			$this->model->save($data);
			return $this->respond($data);
		}

	}

	public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
			return $this->respondDeleted($data);
		}else{
			return $this->failNotFound('Item not found');
		}
	}

}
