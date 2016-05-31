<div id="imagery">
						<a href="outline.php?noticeID=<?php echo $notice['noticeID']; ?>">
								<img src="<?php echo $notice['picture_name']; ?>" alt="" /></a>
								</div>

								<script type="text/javascript">
									(function(){
										var img = document.getElementById('imagery').firstChild;
										img.onload=function(){
											if (img.height>img.width) {
												img.height='100%';
												img.width='auto';
											}
										};
									}());
								</script>
								<!--<div class="mask mask1">
									<span>Quick View</span>
								</div>-->
						
						<h4><?php echo $notice['name']; ?> <br/></h4>
						
						Email: <?php echo $notice['email']; ?><br/>
						Category: <?php echo $notice['category']; ?><br/>
						Description: <?php echo $notice['description']; ?><br/>
						Date: <?php echo $notice['edate']; ?><br/>
						Uploaded By: <?php echo $userRow['username']; ?><br/>

						<p><span class=" item_price"> <?php 
						if ($notice['charges'] > 1) {
							# code...
							echo "KShs.". $notice['charges'];
						} else  echo "FREE";  
						?>