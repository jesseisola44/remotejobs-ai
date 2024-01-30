<?php
/*
Plugin Name: JobFinder | RemoteJobs.lk
Description: Are you ready to take the next step in your career? Look no further than JobFinder, your go-to platform for discovering exciting job opportunities across various industries. We've streamlined the job search process to make it easier for both employers and job seekers.
Version: 1.0
Author: RemoteJobs.lk
*/

// Shortcode function
function jobfinder_form_shortcode() {
    ob_start(); // Start output buffering
    ?>

    <div class="jobfinder-form-container">
        <h2>Job Application Form</h2>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="jobfinder_form_submission">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="resume">Resume (PDF only):</label>
            <input type="file" id="resume" name="resume" accept=".pdf" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    return ob_get_clean(); // End and clean the output buffer
}

// Register the shortcode
add_shortcode('jobfinder_form', 'jobfinder_form_shortcode');

// Form submission handler
function jobfinder_form_submission_handler() {
    // Handle the form submission logic here
    // You can use $_POST['name'], $_POST['email'], $_FILES['resume'], etc.

    // For demonstration purposes, just redirect back to the homepage
    wp_redirect(home_url());
    exit();
}

// Register the form submission handler
add_action('admin_post_jobfinder_form_submission', 'jobfinder_form_submission_handler');
add_action('admin_post_nopriv_jobfinder_form_submission', 'jobfinder_form_submission_handler');
