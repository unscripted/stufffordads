<?php
/*
Template Name: Contact Page
*/
?>

<?php 
if( of_get_option('security_question') ):
$securityQuestion = of_get_option('security_question');
else:
$securityQuestion = "What is 2+3?";
endif;

if( of_get_option('security_answer') ):
$securityAnswer = of_get_option('security_answer');
else:
$securityAnswer = "5";
endif;

if( of_get_option('contact_email') ):
$contactEmail = of_get_option('contact_email');
else:
$contactEmail = get_option('admin_email');
endif;

if( of_get_option('contact_subject') ):
$contactSubject = of_get_option('contact_subject');
else:
$contactSubject = 'ShowyCase';
endif;

if(isset($_POST['submitted'])):
	
	// NAME CHECHING
	if(trim($_POST['contactName']) === '') {
	$nameError = __('You forgot to enter your name.', 'premitheme');
	$hasError = true;
	} else {
	$name = trim($_POST['contactName']);
	}
	
	// EMAIL CHECHING
	if(trim($_POST['email']) === '')  {
	$emailError = __('You forgot to enter your email address.', 'premitheme');
	$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", trim($_POST['email']))) {
	$emailError = __('You entered an invalid email address.', 'premitheme');
	$hasError = true;
	} else {
	$email = trim($_POST['email']);
	}
	
	// MESSAGE CHECHING
	if(trim($_POST['comments']) === '') {
	$commentError = __('You forgot to enter your comments.', 'premitheme');
	$hasError = true;
	} else {
  	if(function_exists('stripslashes')) {
  	$comments = stripslashes(trim($_POST['comments']));
  	} else {
  	$comments = trim($_POST['comments']);
  	}
	}
	
	// SECURITY CHECHING
	if( of_get_option("use_security") == '' || of_get_option("use_security") != '0' ):
  	if(trim($_POST['security']) === '')  {
  	$securityError = __('You forgot to enter the security answer.', 'premitheme');
  	$hasError = true;
  	} else if (trim($_POST['security']) != $securityAnswer) {
  	$securityError = __('You entered a wrong security answer.', 'premitheme');
  	$hasError = true;
  	}
	endif;
	
	// IF EVERYTHING IS OK
	if(!isset($hasError)):
		
		$emailTo = $contactEmail;
		$subject = '['.$contactSubject.'] from '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
		
		mail($emailTo, $subject, $body, $headers);
		
		$emailSent = true;
		
	endif;
endif;
?>

<?php get_header();?>

    <section id="content">
    
      <?php while ( have_posts() ) : the_post(); ?>
      
      <div id="page-title">
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
      </div>
      
      <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
      
        <?php // SHOW GOOGLE MAP IF SET
				if( of_get_option('google_map') || ( of_get_option('google_lat') && of_get_option('google_lng') ) ): ?>
				<div id="contact-map"><?php echo of_get_option('google_map'); ?></iframe>
				</div>
				
				
				<?php // ELSE SHOW FEATURED IMAGE IF SET
				elseif ( has_post_thumbnail()): ?>
				<div class="entry-thumb">
					<?php the_post_thumbnail('fullwidth-page-image'); ?>
				</div>
				<?php endif; ?>
				
				
				<?php // SHOW CONTACT INFO IF SET
				if( of_get_option('contact_address') || of_get_option('contact_phone') || of_get_option('contact_fax') ): ?>
				<div id="contact-info">
					<h2><?php _e('Contact Info', 'premitheme') ?></h2>
					<ul>
						<?php if( of_get_option('contact_address') ): ?>
						<li>
							<span></span>
							<h6><?php _e('Address', 'premitheme') ?></h6>
							<p><?php echo of_get_option('contact_address'); ?></p>
						</li>
						<?php endif; ?>
						<?php if( of_get_option('contact_phone') ): ?>
						<li>
							<span></span>
							<h6><?php _e('Phone', 'premitheme') ?></h6>
							<p><?php echo of_get_option('contact_phone'); ?></p>
						</li>
						<?php endif; ?>
						<?php if( of_get_option('contact_fax') ): ?>
						<li>
							<span></span>
							<h6><?php _e('Fax', 'premitheme') ?></h6>
							<p><?php echo of_get_option('contact_fax'); ?></p>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				
				
				<?php // SHOW CONTENT IF NOT EMPTY
				if(trim($post->post_content) != '' ): ?>
				<div class="entry-content">
					<?php the_content(); ?>
					
					<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				
				<?php // CONTACT FORM
				if(isset($emailSent) && $emailSent == true): ?>
								
				<h2 class="thanks"><?php _e('Thanks, your email was successfully sent', 'premitheme') ?></h2>
				
				<?php else: ?>
				
				<?php if(isset($hasError)): ?>
			    <h2 class="error"><?php _e('There was an error submitting the form', 'premitheme') ?></h2>
				<?php endif; ?>
				
				<form action="<?php the_permalink(); ?>" id="contactf" method="post">
					<p><em><?php _e('All fields are required', 'premitheme') ?></em></p>
					
					<p>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required" />
						<label for="contactName"><?php _e('Name', 'premitheme') ?></label>
						<?php if(isset($nameError) && $nameError != '') { ?><em class="error"><?php echo $nameError;?></em><?php } ?>
					</p>
					
					<p>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required email"/>
						<label for="email"><?php _e('Email', 'premitheme') ?></label>
						<?php if(isset($emailError) && $emailError != '') { ?><em class="error"><?php echo $emailError;?></em><?php } ?>
					</p>
					
					<p>
						<textarea name="comments" id="commentsText" rows="8" cols="45" class="required"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
						<label for="comments"><?php _e('Message', 'premitheme') ?></label>
						<span class="clear" style="clear: left;"></span>
						<?php if(isset($commentError) && $commentError != '') { ?><em class="error"><?php echo $commentError;?></em><?php } ?>
					</p>
					
					<?php if( of_get_option("use_security") == '' || of_get_option("use_security") != '0' ): ?>
					<p>
						<input style="width: 50px;" type="text" name="security" id="security" value="<?php if(isset($_POST['security']))  echo $_POST['security'];?>" class="required"/>
						<label for="security"><?php echo $securityQuestion; ?></label>
						<?php if(isset($securityError) && $securityError != '') { ?><em class="error"><?php echo $securityError;?></em><?php } ?>
					</p>
					<?php endif; ?>
					
					<p>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit"><?php _e('Send', 'premitheme') ?></button>
					</p>
				</form>
				<?php endif; ?>
				<div class="clear"></div>
      
      </article>
      
      <?php endwhile; ?>
    
    </section><!-- #content -->
    
<?php get_footer(); ?>
      
      