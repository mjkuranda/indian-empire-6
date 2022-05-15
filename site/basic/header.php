<header>
	<div>
		<!-- User section -->
		<section id="user">
			<div id="user-av" class="flexBox">
				<svg viewBox="-42 0 512 512.002" xmlns="http://www.w3.org/2000/svg">
					<path d="m210.351562 246.632812c33.882813 0 63.222657-12.152343 87.195313-36.128906 23.972656-23.972656 36.125-53.304687 36.125-87.191406 0-33.875-12.152344-63.210938-36.128906-87.191406-23.976563-23.96875-53.3125-36.121094-87.191407-36.121094-33.886718 0-63.21875 12.152344-87.191406 36.125s-36.128906 53.308594-36.128906 87.1875c0 33.886719 12.15625 63.222656 36.132812 87.195312 23.976563 23.96875 53.3125 36.125 87.1875 36.125zm0 0"/><path d="m426.128906 393.703125c-.691406-9.976563-2.089844-20.859375-4.148437-32.351563-2.078125-11.578124-4.753907-22.523437-7.957031-32.527343-3.308594-10.339844-7.808594-20.550781-13.371094-30.335938-5.773438-10.15625-12.554688-19-20.164063-26.277343-7.957031-7.613282-17.699219-13.734376-28.964843-18.199219-11.226563-4.441407-23.667969-6.691407-36.976563-6.691407-5.226563 0-10.28125 2.144532-20.042969 8.5-6.007812 3.917969-13.035156 8.449219-20.878906 13.460938-6.707031 4.273438-15.792969 8.277344-27.015625 11.902344-10.949219 3.542968-22.066406 5.339844-33.039063 5.339844-10.972656 0-22.085937-1.796876-33.046874-5.339844-11.210938-3.621094-20.296876-7.625-26.996094-11.898438-7.769532-4.964844-14.800782-9.496094-20.898438-13.46875-9.75-6.355468-14.808594-8.5-20.035156-8.5-13.3125 0-25.75 2.253906-36.972656 6.699219-11.257813 4.457031-21.003906 10.578125-28.96875 18.199219-7.605469 7.28125-14.390625 16.121094-20.15625 26.273437-5.558594 9.785157-10.058594 19.992188-13.371094 30.339844-3.199219 10.003906-5.875 20.945313-7.953125 32.523437-2.058594 11.476563-3.457031 22.363282-4.148437 32.363282-.679688 9.796875-1.023438 19.964844-1.023438 30.234375 0 26.726562 8.496094 48.363281 25.25 64.320312 16.546875 15.746094 38.441406 23.734375 65.066406 23.734375h246.53125c26.625 0 48.511719-7.984375 65.0625-23.734375 16.757813-15.945312 25.253906-37.585937 25.253906-64.324219-.003906-10.316406-.351562-20.492187-1.035156-30.242187zm0 0"/>
				</svg>
			</div>
			<div id="user-hello">
				<?php
					$user = 'guest';
					$logged_in = false;
					
					if (isset($_SESSION['user']) && isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
						$user = $_SESSION['user'];
						$logged_in = true;
					}
				?>
				Hello,&nbsp;<strong><?php echo $user; ?></strong>!
				<?php 
					if ($logged_in) { ?>
						&nbsp;
						<a href="user" title="User settings">
							<svg id="user-settings" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<path d="M256,181c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C331,214.647,297.353,181,256,181z
									"/>
								<path d="M512,298.305v-84.609l-69.408-13.667c-3.794-12.612-8.833-24.771-15.103-36.343l38.73-58.096l-59.81-59.81l-58.096,38.73
									c-11.572-6.27-23.73-11.309-36.343-15.103L298.305,0h-84.609l-13.667,69.408c-12.612,3.794-24.771,8.833-36.343,15.103
									L105.59,45.78l-59.81,59.81l38.73,58.096c-6.27,11.572-11.309,23.73-15.103,36.343L0,213.695v84.609l69.408,13.667
									c3.794,12.612,8.833,24.771,15.103,36.343L45.78,406.41l59.81,59.81l58.096-38.73c11.572,6.27,23.73,11.309,36.343,15.103
									L213.695,512h84.609l13.667-69.408c12.612-3.794,24.771-8.833,36.343-15.103l58.096,38.73l59.81-59.81l-38.73-58.096
									c6.27-11.572,11.309-23.73,15.103-36.343L512,298.305z M256,361c-57.891,0-105-47.109-105-105s47.109-105,105-105
									s105,47.109,105,105S313.891,361,256,361z"/>
							</svg>
						</a>
						&nbsp;&nbsp;
						<a href="log-out" title="Log out! :(">
							<svg id="user-logout" viewBox="0 0 512.00533 512" xmlns="http://www.w3.org/2000/svg"><path d="m320 277.335938c-11.796875 0-21.332031 9.558593-21.332031 21.332031v85.335937c0 11.753906-9.558594 21.332032-21.335938 21.332032h-64v-320c0-18.21875-11.605469-34.496094-29.054687-40.554688l-6.316406-2.113281h99.371093c11.777344 0 21.335938 9.578125 21.335938 21.335937v64c0 11.773438 9.535156 21.332032 21.332031 21.332032s21.332031-9.558594 21.332031-21.332032v-64c0-35.285156-28.714843-63.99999975-64-63.99999975h-229.332031c-.8125 0-1.492188.36328175-2.28125.46874975-1.027344-.085937-2.007812-.46874975-3.050781-.46874975-23.53125 0-42.667969 19.13281275-42.667969 42.66406275v384c0 18.21875 11.605469 34.496093 29.054688 40.554687l128.386718 42.796875c4.351563 1.34375 8.679688 1.984375 13.226563 1.984375 23.53125 0 42.664062-19.136718 42.664062-42.667968v-21.332032h64c35.285157 0 64-28.714844 64-64v-85.335937c0-11.773438-9.535156-21.332031-21.332031-21.332031zm0 0"/><path d="m505.75 198.253906-85.335938-85.332031c-6.097656-6.101563-15.273437-7.9375-23.25-4.632813-7.957031 3.308594-13.164062 11.09375-13.164062 19.714844v64h-85.332031c-11.777344 0-21.335938 9.554688-21.335938 21.332032 0 11.777343 9.558594 21.332031 21.335938 21.332031h85.332031v64c0 8.621093 5.207031 16.40625 13.164062 19.714843 7.976563 3.304688 17.152344 1.46875 23.25-4.628906l85.335938-85.335937c8.339844-8.339844 8.339844-21.824219 0-30.164063zm0 0"/></svg>
						</a>
				<?php
					} else { ?>
						<span id="reglog-text">&nbsp;<a href="log#log">Log in</a>&nbsp;or&nbsp;<a href="reg#reg">create</a>&nbsp;an account!</span>
				<?php
					}
				?>
			</div>
		</section>
		
		<!-- Navigation on the website -->
		<nav>
			<div id="nav-char">&equiv;</div>
			<div id="nav-list">
				<!--<div><a style="width: inherit;">Siema</a></div>-->
				<a href="main"><div>Main page</div></a>
				<a href="game"><div>Play game</div></a>
				<a href="forum"><div>Forum & Community</div></a>
				<a href="help"><div>Help</div></a>
				<a href="credits"><div>Credits</div></a>
			</div>
		</nav>
	</div>
</header>