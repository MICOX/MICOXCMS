<?php
namespace MICOXCMS\Interfaces {
  interface IApplication extends ISingletonComponent {
    public function OutputBuffer($buffer);
    public function Init();
    public function Run();
    public function Done();
  }
}