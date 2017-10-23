<?php
/**
 * This file is responsible for displaying question page
 * This file can be overridden by creating a anspress directory in active theme folder.
 *
 * @package    AnsPress
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GNU Public License
 * @author    Rahul Aryan <support@anspress.io>
 */
$ans_count 		= ap_question_get_the_answer_count();
$last_active 	= ap_question_get_the_active_ago();
$total_subs 	= ap_question_get_the_subscriber_count();
$view_count 	= ap_question_get_the_view_count();
?>
<?php if( !get_query_var( 'ap_hide_list_head' ) ): ?>
			<?php ap_get_template_part('list-head'); ?>
		<?php endif; ?>
<div id="ap-single" class="ap-q clearfix">
	<?php
		/**
		 * By default this title is hidden
		 */
	if ( ap_opt('show_title_in_question' ) ) :
	?>
	<h1 class="entry-title"><a href="<?php get_permalink() ?>"><?php the_title(); ?></a></h1>
	<?php endif; ?>

    <div class="ap-question-lr row" itemtype="https://schema.org/Question" itemscope="">
		<div class="ap-q-left col-md-12">
            <div class="ap-question-meta clearfix">
				<?php echo ap_display_question_metas() ?>
				<?php
					$ans_count 		= ap_question_get_the_answer_count();
					$last_active 	= ap_question_get_the_active_ago();
					$total_subs 	= ap_question_get_the_subscriber_count();
					$view_count 	= ap_question_get_the_view_count();
					$last_active_time = ap_human_time( mysql2date( 'G', $last_active ) );
					echo '<span class="ap-display-meta-item"><span class="stat-label apicon-pulse"></span><span class="stat-value"><time class="published updated" itemprop="dateModified" datetime="'.mysql2date( 'c', $last_active ).'">'.$last_active_time.'</time></span></span>' ;
					echo '<span class="ap-display-meta-item"><span class="stat-label apicon-eye"></span><span class="stat-value">'.sprintf( _n( 'One time', '%d times', $view_count, 'anspress-question-answer' ), $view_count ).'</span></span>' ;
					echo '<span class="ap-display-meta-item"><span class="stat-label apicon-answer"></span><span class="stat-value">'.sprintf( _n( '%2$s1%3$s answer', '%2$s%1$d%3$s answers', $ans_count, 'anspress-question-answer' ), $ans_count, '<span data-view="answer_count">', '</span>' ).'</span></span>' ;
				?>
            </div>
			<div id="question" role="main" class="ap-content question" data-id="<?php ap_question_the_ID(); ?>">
				<div class="ap-single-vote"><?php ap_question_the_vote_button(); ?></div>
				<?php
					/**
					 * ACTION: ap_before_question_title
					 * @since 	2.0
					 */
					do_action('ap_before_question_title' );
				?>
                <div class="ap-avatar">
					<a href="<?php ap_question_the_author_link(); ?>"<?php ap_hover_card_attributes(ap_question_get_author_id() ); ?>>
						<?php ap_question_the_author_avatar( ap_opt('avatar_size_qquestion' ) ); ?>
                    </a>
                </div>
                <div class="ap-q-cells clearfix">
                    <div class="ap-q-metas">
						<?php ap_user_display_meta(true, false, true ); ?>
						<span><?php ap_question_the_time(); ?></span>
                    </div>

                    <!-- Start ap-content-inner -->
                    <div class="ap-q-inner">
						<?php
							/**
							 * ACTION: ap_before_question_content
							 * @since 	2.0.0
							 */
							do_action('ap_before_question_content' );
						?>
                        <div class="question-content ap-q-content" itemprop="text">
							<?php the_content(); ?>
                        </div>

						<?php
							/**
							 * ACTION: ap_after_question_content
							 * @since 	2.0.0-alpha2
							 */
							do_action('ap_after_question_content' );
							
						?>

						<?php ap_question_the_active_time(); ?>
						<?php ap_post_status_description(ap_question_get_the_ID() );	?>
						<?php ap_post_actions_buttons() ?>

						<?php
							/**
							 * ACTION: ap_after_question_actions
							 * @since 	2.0
							 */
							do_action('ap_after_question_actions' );
						?>
                    </div>
                    <!-- End ap-content-inner -->
					<?php ap_question_the_comments(); ?>
                </div>
            </div>

			<?php
				/**
				 * Output list of answers
				 */
				ap_question_the_answers();
			?>
			<?php ap_question_the_answer_form(); ?>
        </div>
    </div>
</div>
