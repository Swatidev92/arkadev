<?php $blogUrl = $items[1];
	$latestBlogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 AND url='$blogUrl' ");
	$latestBlogRes = $latestBlogQry->fetch_array();
	$catArr = explode(',',$latestBlogRes['cat_id']);
?>


<div class="page-head-banner">
	<img src="<?=SITE_PATH.'uploaded_files/blog/'.$latestBlogRes['blog_image']?>">
</div>	
	
<div class="blog-detail default-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
				<div class="sw_left_heading_wraper">
					<h1><span class="heading-bold"><?=$latestBlogRes['title']?></span></h1>
				</div>
			</div>
			<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
				<div class="blog-detail-right">
					<div class="blog-list-content"><?=$latestBlogRes['blog_content']?></div>
					
					<div class="detail-tags">
						<?php $blogCatQry = $cms->db_query("SELECT * FROM #_blog_catagories where status=1 AND is_deleted=0 ");
						if($blogCatQry->num_rows>0){
						?>
						<ul class="news-tags">
							<?php while($blogCatRes = $blogCatQry->fetch_array()){
							if(in_array($blogCatRes['id'],$catArr)){ ?>
							<li><?=$blogCatRes['cat_name']?></li>
							<?php } } ?>
						</ul>
						<?php } ?>
					</div>
				</div>
				
				<?php $blogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 AND url NOT IN ('$blogUrl') order by post_date ASC ");
				if($blogQry->num_rows>0){
				?>
				<div class="more-blogs-detail-page">
					<div class="row">
						<?php while($blogRes = $blogQry->fetch_array()){?>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
							<div class="single-blog-item">
								<div class="blog-detail-img">
									<img class="img-responsive" src="<?=SITE_PATH.'uploaded_files/blog/'.$blogRes['blog_image']?>" alt="<?=$blogRes['title']?>" width="100%">
								</div>
								<div class="blog-list-title">
									<h2 class="blog-list-title"><a href="<?=SITE_PATH.'blog/'.$latestBlogRes['url']?>"><?=$blogRes['title']?></a></h2>
								</div>
								<div class="blog-list-content"><?=trim_content(strip_tags($blogRes['blog_content']))?></div>
								<div class="blog-read-more">
									<p><a href="<?=SITE_PATH.'blog/'.$blogRes['url']?>" class="waves-effect waves-light waves-ripple">Read more <i class="fa fa-long-arrow-right"></i></a></p>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>