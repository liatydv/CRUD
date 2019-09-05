<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Crud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
	protected $table;

	public function __construct($table){
		$this->table=$table;

	}
	
    public function indexAction(){
		$posts = $this ->table->fetchAll();
        return new ViewModel(['posts' => $posts]);
	}
	
	public function addAction(){
		$form = new \Crud\Form\PostForm;
		$request = $this->getRequest();
		if(!$request->isPost()){
		return new ViewModel([ 'form' => $form ]);
	}
	$post = new \Crud\Model\Crud();
	$form->setData($request->getPost());
	if(!$form->isValid()){
		exit('El id no es correcto');
	}
	$post->exchangeArray($form->getData());
	$this->table->saveData($post);
	return $this->redirect()->toRoute('home', [
		'controller' => 'index',
		'action' =>'add'
	]);
}

	public function editAction(){
			$id = (int) $this->params()->fromRoute('id', 0);
			if($id == 0){
				exit('Error');
			}
			try{
			$post = $this->table->getPost($id);
			} 
			catch(Exception $e){
				exit('Error');
			}
			$form= new \Crud\Form\PostForm();
			$form->bind($post);
			$request = $this->getRequest();
			if(!$request->isPost()){
				return new ViewModel([
					'form' => $form,
					'id' => $id
				]);
			}
$form->setData($request->getPost());
if(!$form->isValid()){
	exit('Error');
}
$this->table->saveData($post);

return $this->redirect()->toRoute('home', [
	'controller' => 'edit',
	'action' => 'edit',
	'id' => $id
]);
	}
	public function deleteAction(){
		$id = (int) $this->params()->fromRoute('id', 0);
			if($id == 0){
				exit('Error');
			}
			try{
			$post = $this->table->getPost($id);
			} 
			catch(Exception $e){
				exit('Error');
			}
			$request =$this->getRequest();
			if(!$request->isPost()){
				return new ViewModel([
'post' => $post,
'id' => $id
				]);
			}
	$delete = $request->getPost('delete', 'No');
	if($delete == 'Yes'){
		$id = (int) $post->getId();
		$this->table->deletePot($id);
		return $this->redirect()->toRoute('home');
	}	
	else{
		return $this->redirect()->toRoute('home');
	}
	}
}