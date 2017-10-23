<?php
/**
 * Display user about page
 *
 * @link http://wp3.in
 * @since unknown
 * @package AnsPress
 */
global $questions;
?>
<div class="ap-about">

	<?php do_action( 'ap_user_about_block_top'); ?>

    <div class="ap-about-block user-stats">

		<h3><?php echo ap_icon( 'rss', true ); ?> <?php _e( 'Stats', 'anspress-question-answer' ); ?></h3>

        <div class="ap-about-block-c">

            <ul class="ap-about-stats clearfix">
                <li>
                    <div class="ap-about-stats-item">
						<?php echo ap_icon( 'answer', true ); ?>
						<?php printf( __( '%d answers, %d selected', 'anspress-question-answer' ), ap_user_get_the_meta( '__total_answers' ), ap_user_get_the_meta( '__best_answers' ) ); ?>
                    </div>
                </li>
                <li>
                    <div class="ap-about-stats-item">
						<?php echo ap_icon( 'question', true ); ?><?php printf( __( '%d post, %d solved', 'anspress-question-answer' ), ap_user_get_the_meta( '__total_questions' ), ap_user_get_the_meta( '__solved_answers' ) ); ?>
                    </div>
                </li>
                <li>
                    <div class="ap-about-stats-item">
						<?php echo ap_icon( 'clock', true ); ?><?php printf( __( 'Member for %s', 'anspress-question-answer' ), ap_user_get_member_for() ); ?>
                    </div>
                </li>
                <li>
                    <div class="ap-about-stats-item">
						<?php echo ap_icon( 'eye', true ); ?><?php printf( __( '%d profile views', 'anspress-question-answer' ), ap_user_get_the_meta( '__profile_views' ) ); ?>
                    </div>
                </li>
                <li>
                    <div class="ap-about-stats-item">
						<?php
							echo ap_icon( 'clock', true );

						if ( ap_user_get_the_meta( '__last_active' ) != 0 ) {
							printf( __( 'Last seen %s', 'anspress-question-answer' ), ap_human_time( ap_user_get_the_meta( '__last_active' ), false ) );
						} else {
							_e( 'Never logged in', 'anspress-question-answer' );
						}
						?>
                    </div>
                </li>
            </ul><!-- close .ap-about-stats -->

        </div><!-- close .ap-about-block-c -->

    </div><!-- close .ap-about-block.user-stats -->

    <?php do_action( 'ap_user_about_block_after_status'); ?>

    <div class="ap-about-block">
		

        <div class="ap-about-block-c">

          

            </div><!-- close .ap-about-rep -->

        </div><!-- close .ap-about-block-c -->
    </div><!-- close .ap-about-block -->

    <div class="ap-about-block">
		

        <div class="ap-about-block-c">

            

        </div><!-- close .ap-about-block-c -->

    </div><!-- close .ap-about-block -->

    <div class="ap-about-block top-answers">
		<h3><?php echo ap_icon( 'answer', true ); ?> <?php _e( 'Top Answers', 'anspress-question-answer' ); ?></h3>
        <div class="ap-about-block-c">
			<?php
				$answers = ap_get_answers(array(
							'author' 	=> ap_get_displayed_user_id(),
							'showposts' => 5,
							'sortby' 	=> 'voted',
						));
			?>
			<?php if ( $answers->have_posts() ) :   ?>
				<?php while ( $answers->have_posts() ) : $answers->the_post(); ?>
					<?php ap_get_template_part( 'user/list-answer' ); ?>
				<?php endwhile; ?>
                <div class="ap-user-posts-footer">
					<?php printf( __( 'More answers by %s', 'anspress-question-answer' ), ap_user_get_the_display_name() ); ?>
					<a href="<?php echo ap_user_link( ap_get_displayed_user_id(), 'answers' ); ?>"><?php _e( 'view', 'anspress-question-answer' ); ?>&rarr;</a>
                </div>
			<?php else : ?>
				<?php _e( 'No answer posted yet!', 'anspress-question-answer' ); ?>
			<?php endif; ?>
        </div>
    </div>

    <div class="ap-about-block top-answers">
		<h3><?php echo ap_icon( 'question', true ); ?> <?php _e( 'New posts', 'anspress-question-answer' ); ?></h3>
        <div class="ap-about-block-c">
			<?php $questions = ap_get_questions( array( 'author' => ap_get_displayed_user_id(), 'showposts' => 5, 'sortby' => 'newest' ) ); ?>

			<?php if ( ap_have_questions() ) : ?>

				<?php while ( ap_questions() ) : ap_the_question(); ?>
					<?php ap_get_template_part( 'user/list-question' ); ?>
				<?php endwhile; ?>

                <div class="ap-user-posts-footer">
					<?php printf( __( 'More posts by %s', 'anspress-question-answer' ), ap_user_get_the_display_name() ); ?>
					<a href="<?php echo ap_user_link( ap_get_displayed_user_id(), 'questions' ); ?>"><?php _e( 'view', 'anspress-question-answer' ); ?>&rarr;</a>
                </div>
			<?php else : ?>

				<?php _e( 'No post asked yet!', 'anspress-question-answer' ); ?>

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
        </div>
    </div>

    <?php do_action( 'ap_user_about_block_bottom'); ?>

</div>
