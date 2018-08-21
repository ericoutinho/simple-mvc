<?php
/**
 * Autoload - Autoload PSR das classes do app
 * PHP version 7
 * @author Eric Coutinho <ericoutinho@gmail.com>
 * @package base/core
 */
class Autoload{

    protected $path;
    protected $extensao;
    protected $prefixo;
    protected $sufixo;

    /**
     * Define o diretório padrão de inclusão
     * @param string $path - Diretório padrão de inclusão
     * @return void - Não retorna nada
     */
    public function setPath(string $path){
        set_include_path($path);
    }

    /**
     * Define a extensão do arquivo
     * @param string $extensao - A extensão do arquivo
     * @return void - Não retorna nada
     */
    public function setExtensao(string $extensao){
        $this->extensao = ".{$extensao}";
    }

    /**
     * Define um sufixo para o arquivo
     * @param string $name - Sufixo do arquivo
     * @return void - Não retorna nada
     */
    public function setSufixo(string $sufixo){
        $this->sufixo = $sufixo;
    }

    /**
     * Define um prefixo para o arquivo
     * @param string $prefixo - Prefixo do arquivo
     * @return void - Não retorna nada
     */
    public function setPrefixo(string $prefixo){
        $this->prefixo = $prefixo;
    }

    /**
     * Define o nome de arquivo da classe
     * @param string $classe - Nome da classe a ser carregada
     * @return string - O nome do arquivo
     */
    protected function setNomeArquivo(string $classe):string{
        $nomeClasse     = ltrim($classe, "\\");
        $nomeArquivo    = "";
        $namespace      = "";
        if ($ultimaPos  = strrpos($nomeClasse, "\\")){
            $namespace  = substr($nomeClasse, 0, $ultimaPos);
            $nomeClasse = substr($nomeClasse, $ultimaPos + 1);
            $nomeClasse = $this->prefixo . $nomeClasse . $this->sufixo;
            $nomeArquivo = str_replace("\\", DS, $namespace) . DS;
        }
        $nomeArquivo .= str_replace("_", DS, $nomeClasse) . $this->extensao;
        return $nomeArquivo;
    }

    /**
     * Carrega as classes de base
     * @param string $nomeClasse - O nome da classe a carregar
     * @return void - Não retorna nenhuma informação
     */
    public function loadCore(string $nomeClasse){
        $arquivo = $this->setNomeArquivo($nomeClasse);
        $arquivo = get_include_path() . DS . "libs" . DS . $arquivo;
        if(is_readable($arquivo)){
            require($arquivo);
        }
    }

    /**
     * Carrega as classes dos modulos
     * @param string $nomeClasse - O nome da classe a carregar
     * @return void - Não retorna nenhuma informação
     */
    public function loadModulos(string $nomeClasse){
        $arquivo = $this->setNomeArquivo($nomeClasse);
        $arquivo = get_include_path() . DS . "app" . DS . "modulos" . DS . $arquivo;
        if(is_readable($arquivo)){
            require($arquivo);
        }
    }

}