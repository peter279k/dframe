<?php
/**
 * DframeFramework
 * Copyright (c) Sławomir Kaleta
 *
 * @license https://github.com/dframe/dframe/blob/master/LICENCE (MIT)
 */

namespace Dframe;

use Dframe\BaseException;

/**
 * Short Description
 *
 * @author Sławek Kaleta <slaszka@gmail.com>
 */
abstract class View extends Loader implements \Dframe\View\ViewInterface
{
    public function __construct($baseClass)
    {
        parent::__construct($baseClass);
        
        if (!isset($this->view)) {
            throw new BaseException('Please Define view engine in app/View.php', 500);
        }

    }

    public function assign($name, $value) 
    {
        return $this->view->assign($name, $value);
    }

    public function render($data, $type = null)
    {

        if (empty($type) OR $type == 'html') {
            return $this->view->renderInclude($data);

        } elseif ($type == 'jsonp') {
            return $this->view->renderJSONP($data);
        
        } else {
            return $this->view->renderJSON($data);
        }
               
    } 

    /**
     * Przekazuje kod do szablonu
     *
     * @param string $name Nazwa pliku
     * @param string $path Ścieżka do szablonu
     *
     * @return void
     */

    public function fetch($name, $path = null) 
    {
        return $this->view->fetch($name, $path);

    }

    /**
     * Include pliku
     */
    public function renderInclude($name, $path = null)
    {
        return $this->view->renderInclude($name, $path);
    }
     
    /**
     * Wyświetla dane JSON.
     *
     * @param array $data Dane do wyświetlenia
     */
    public function renderJSON($data, $status = false) 
    {
        return $this->view->renderJSON($data, $status);

    }
 
    /**
     * Wyświetla dane JSONP.
     *
     * @param array $data Dane do wyświetlenia
     */
    public function renderJSONP($data) 
    {
        return $this->view->renderJSONP($data);
    }
}