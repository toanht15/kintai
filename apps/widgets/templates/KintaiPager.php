
<?php if ($this->TotalCount): ?>
<div class="pager1">
   <p><?php assign($this->TotalCount) ?>件中<?php assign($this->Count * ($this->CurrentPage - 1) + 1) ?>件～<?php assign(($this->Count * $this->CurrentPage < $this->TotalCount) ? $this->Count * $this->CurrentPage : $this->TotalCount) ?>件表示しています</p>
<?php if ($this->TotalCount > $this->Count): ?>
       <ul>
           <?php if ($this->CurrentPage > 1): /* << < */?>
               <li class="first"><a href="<?php assign(str_replace("\x0bpage\x0b", 1, $this->URLBase)) ?>">最初のページヘ</a></li>
               <li class="prev"><a href="<?php assign(str_replace("\x0bpage\x0b", $this->CurrentPage - 1, $this->URLBase)) ?>">前のページへ</a></li>
           <?Php endif; ?>
           <?php for ($i = $this->Start; $i <= $this->End; $i++): ?>
               <?php if ($this->CurrentPage == $i): ?>
                   <li><span><?php assign($i) ?></span></li>
               <?php else: ?>
                   <li><a href="<?php assign(str_replace("\x0bpage\x0b", $i, $this->URLBase)) ?>"><?php assign($i) ?></a></li>
               <?php endif; ?>
           <?php endfor; ?>
           <?php if ($this->CurrentPage < $this->TotalPage): /* 99 > >> */?>
               <li class="next"><a href="<?php assign(str_replace("\x0bpage\x0b", $this->CurrentPage + 1, $this->URLBase)) ?>">次のページへ</a></li>
               <li class="last"><a href="<?php assign(str_replace("\x0bpage\x0b", $this->TotalPage, $this->URLBase)) ?>">最後のページヘ</a></li>
           <?php endif; ?>
       </ul>
<?php endif; ?>
</div>
<?php endif; ?>