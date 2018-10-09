<?php
     class footer
     {
         function __construct()
         {

         }

         public function footer()
         {
             echo <<< EOT
             <div class="weui-footer" style="position:fixed;bottom:1%;text-align: center;width: 100%;font-size:12px">
              <p class="weui-footer__text">Copyright &copy; 20016-2018 宇通科技</p>
             </div>
EOT;
         }
     }
?>
