<?php
     class Dialog
     {
         function __construct($id="dialog",$classname = null)
         {
             $this->id = $id;
             $this->classname = $classname;
         }

         public function dialog()
         {
             echo <<< EOT
             <div class="weui_dialog_confirm $this->classname" style="display:none" id="$this->id">
                 <div class="weui_mask"></div>
                 <div class="weui_dialog">
                     <div class="weui_dialog_hd"><strong class="weui_dialog_title">弹窗标题</strong></div>
                     <div class="weui_dialog_bd">自定义弹窗内容<br>...</div>
                     <div class="weui_dialog_ft">
                         <a href="javascript:;" class="weui_btn_dialog default">取消</a>
                         <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
                     </div>
                 </div>
             </div>
EOT;
         }

         private $classname;
         private $id;
     }
?>
