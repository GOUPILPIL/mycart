<?php

class Basket
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
   
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
   
    // THE only instance of the class
    private static $instance;
   
    private function __construct() {}
   
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }
    
    public function addtobakset($id,$number)
    {
        if(empty($_SESSION['cart']))
        {
            $_SESSION['cart'] = [];
        }
        $mainkey = array_search($id, array_column($_SESSION['cart'], "id"));
        if($mainkey !== false)
        {
            $_SESSION['cart'][$mainkey]['num'] += $number;
        }
        else
        {
            array_push($_SESSION['cart'], ["id" => $id, "num" => $number]);
        }
    }

    public function removefrombasket($id,$number = NULL)
    {
        if(empty($_SESSION['cart']))
        {
            $_SESSION['cart'] = [];
        }
        $mainkey = array_search($id, array_column($_SESSION['cart'], "id"));
        if($mainkey !== FALSE)
        {
            if($number === NULL ||  $_SESSION['cart'][$mainkey]['num'] <= $number)
            {
                array_splice($_SESSION['cart'], $mainkey, 1);
            }
            else
            {
                $_SESSION['cart'][$mainkey]['num'] -= $number;
            }
        }
    }
    public function baskettobdd()
    {
        return (json_encode($_SESSION['cart'])); 
        
    }
    public function bddtobasket($string){
        return(json_decode($string, true));
    }
    
    public function pushbaskettobdd()
    {
        Model::createStatement
        $basket = baskettobdd();
        try{
                $sql = 'INSERT INTO `Basket_save` (`id, `jsonbasket`) VALUES (NULL, :jsonbasket)';
                $statement = $bdd->prepare($sql);
                $statement->bindParam(':jsonbasket', $basket);
                $statement->execute();       
        } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
        }
             return ($bdd->query('SELECT * FROM `Basket_save` WHERE jsonbasket =' . $basket));   
    }
    
    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
       
        return $this->sessionState;
    }
    /**
    *    Destroys the current session.
    *   
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
   
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
           
            return !$this->sessionState;
        }
       
        return FALSE;
    }
}
