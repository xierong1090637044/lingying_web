<?php
     class footer
     {
         function __construct($classname)
         {
             $this->classname = $classname;
         }

         public function footer()
         {
             echo <<< EOT
             <div class="weui-footer $this->classname" style="text-align: center;width: 100%;font-size:12px">
              <p class="weui-footer__text">Copyright &copy; 20016-2018 宇通科技</p>
             </div>
EOT;
         }

         private $classname;
     }
?>
