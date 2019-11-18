<?php 
namespace App\Contracts;

interface PostContract {

   /**
   * Retreview all posts
   * @return Object Post
   *
   */
  public function fetchAll();
   
  /**
   * Retreview spesific posts
   * @param int $id post ID
   * @return Object Post
   */
  public function fetch($id);

   /**
   * Retreview a post's views
   * @param int $id post ID
   */
  public function getPostViews($id);
   
  /**
   * Retreview all views
   *
   */
  public function getViews();

}

?>