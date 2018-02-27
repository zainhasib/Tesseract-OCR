<?php

include("Option\Config.php");

class TesseractOCR
{
    private $image;
    private $executable = 'tesseract';
    private $options = [];

    public function __construct($image)
    {
        $this->image = $image;
    }

    public function run()
    {
        exec($this->buildCommand(), $output);
        return trim(join(PHP_EOL, $output));
    }

    public function buildCommand()
    {
        return Command::build($this->image, $this->executable, $this->options);
    }

    public function executable($executable)
    {
        $this->executable = $executable;
        return $this;
    }

    public function __call($method, $args)
    {
        if ($this->isShortcut($method)) {
            $class = $this->getShortcutClassName($method);
            $this->options[] = $class::buildOption(...$args);
            return $this;
        }
        if ($this->isOption($method)) {
            $class = $this->getOptionClassName($method);
            $this->options[] = new $class(...$args);
            return $this;
        }
        $this->options[] = new Config($method, $args[0]);
        return $this;
    }

    private function isShortcut($name)
    {
        return class_exists($this->getShortcutClassName($name));
    }

    private function getShortcutClassName($name)
    {
        return __NAMESPACE__.'\\Shortcut\\'.ucfirst($name);
    }

    private function isOption($name)
    {
        return class_exists($this->getOptionClassName($name));
    }

    private function getOptionClassName($name)
    {
        return __NAMESPACE__.'\\Option\\'.ucfirst($name);
    }
}



class Command
{
    public static function build($image, $executable, $options=[])
    {
        $cmd = self::escape($executable).' '.self::escape($image).' stdout';
        $cmd.= join('', $options);
        $cmd.= self::isVersion303($executable) ? ' quiet' : '';
        return $cmd;
    }

    private static function isVersion303($executable)
    {
        $version = self::getTesseractVersion($executable);
        return version_compare($version, '3.03', '>=')
            && version_compare($version, '3.04', '<');
    }

    private static function getTesseractVersion($executable)
    {
        exec(self::escape($executable).' --version 2>&1', $output);
        return explode(' ', $output[0])[1];
    }

    private static function escape($str)
    {
        return '"'.addcslashes($str, '\\"').'"';
    }
}



















?>
