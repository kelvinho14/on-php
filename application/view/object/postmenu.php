<li><a href="javascript:;" class="bookmarkpost" data-id="<?php echo $Data['OID']?>"><?php echo ui::fa('bookmark '.($Data['bookmarked']?'bookmarkedicon':'bookmarkicon')).' '.$Lang['savepost']?></a></li>
<li><a href="javascript:;" class="postnotify" data-id="<?php echo $Data['OID']?>"><?php echo ui::fa($Data['notifyon']?'bell-slash':'bell').' '.($Data['notifyon']?$Lang['notifyoff']:$Lang['notifyon'])?></a></li>
<li class="divider"></li>
<li><a href="javascript:;" class="reportpost" data-id="<?php echo $Data['OID']?>"><?php echo ui::fa('exclamation ').' '.$Lang['reportpost']?></a></li>