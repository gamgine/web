<?php
class user
{
  private $id,$name
  public function __construct($id)
  {
    $this->msg = array();
    global $bdd;
    $reponse = $bdd->prepare('SELECT `uid`,`name` FROM `user` where uid = :uid');
    $reponse->execute();
    $donnees = $reponse->fetch()
    $this->id=$donnees['id'];
    $this->id=htmlentities($donnees['name']);
    $reponse->closeCursor();
  }
  public function ech()
  { echo htmlentities($this->name); }
}
class msg
{
  private $id,$author,$msg;
  public function __construct($id,$authorid,$msg)
  {
    $this->id = $id;
    $this->author = new user($authorid);
    $this->msg = htmlentities($msg);
  }
  public function ech()
  { echo "<div>";$this->author->ech();echo"<p>".htmlentities($this->msg)."</p></div>"; }
}
class msglist
{
  private $msg;
  public function __construct()
  {
    global $bdd;
    $this->msg = array();
    global $bdd;
    $reponse = $bdd->prepare('SELECT * FROM `tw`');
    $reponse->execute();
    while ($donnees = $reponse->fetch())
    { array_push( $this->msg, new msg( $donnees['id'] , $donnees['uid'] , $donnees['txt'] ) ); }
    $reponse->closeCursor();
  }
  public function ech()
  { foreach ($this->msg as &$m) {$m->ech();} }
}
