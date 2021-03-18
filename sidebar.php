			<!-- #secondary -->
			<div id="secondary" class="column third">
				<div id="sidebar-1" class="widget-area" role="complementary">			
					<aside id="recent-posts-2" class="widget widget_recent_entries">
					<h4 class="widget-title">Recent Posts</h4>
					<ul>
						<?php
						$posts = explode("\n", $get_post);
						$random_post = array_rand($posts,$randsidebar);
						for ($i=0; $i < ($randsidebar/2); $i++) {
							$ran_title = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/data.txt"));
						?>
						<li class="side">
						<a class="link" href="<?php echo $url.'/'.$posts[$random_post[$i]]; ?>.html"><?php echo $ran_title[0]; ?></a>
						</li>
						<?php } ?>
						<?php if (strlen($ads2) > 10) { ?>
						<li class="side">
						<center><?php echo $ads2; ?></center>
						</li>
						<?php
						}
						$random_post = array_rand($posts,$randsidebar);
						for ($i=($randsidebar/2); $i < $randsidebar; $i++) {
							$ran_title = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/data.txt"));
						?>
						<li class="side">
						<a class="link" href="<?php echo $url.'/'.$posts[$random_post[$i]]; ?>.html"><?php echo $ran_title[0]; ?></a>
						</li>
						<?php } ?>
					</ul>
					</aside>
				</div>
			</div>
			<!-- #secondary -->