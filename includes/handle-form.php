<?php
if (!defined('ABSPATH')) {
    exit;
}

function cv_maker_handle_form_submission() {
    if (!isset($_POST['cv_maker_nonce_field']) || !wp_verify_nonce($_POST['cv_maker_nonce_field'], 'cv_maker_nonce')) {
        wp_die('Security check failed.');
    }

    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $location = sanitize_text_field($_POST['location']);
    $age = intval($_POST['age']);
    $gender = sanitize_text_field($_POST['gender']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $summary = sanitize_textarea_field($_POST['summary']);

    // PDF generation code
    $A4_WIDTH = 595.28;
    $A4_HEIGHT = 841.89;

    $doc = new \Mpdf\Mpdf();
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>' . ucwords($first_name) . ' Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div id="whatToPrint" class="grid-container">
        <div class="zone-1">
            <div class="toCenter">
                <h1 class="highlight">' . ucwords($first_name) . '</h1>
            </div>
            <div class="contact-box">
                <div class="title">
                    <h2>Contact</h2>
                </div>
                <div class="call"><i class="fas fa-phone-alt"></i>
                    <div class="text">' . $phone . '</div>
                </div>
                <div class="Age"><i class="fas fa-envelope"></i>
                    <!--        <div class="text">--><?php //echo $Age;?><!--</div>-->
                </div>
                <div class="email"><i class="fas fa-envelope"></i>
                    <div class="text">' . $email . '</div>
                </div>
            </div>
            <div class="personal-box">
                <div class="title">
                    <h2>Skills</h2>
                </div>';

    // Skills
    for ($j = 0; $j < count($skills); $j++) {
        $html .= '<div class="skill-1">
                    <p><strong>' . strtoupper($skills[$j]) . '</strong></p>
                    <div class="progress">';
        for ($i = 0; $i < $skill_levels[$j]; $i++) {
            $html .= '<div class="fas fa-star active"></div>';
        }
        $html .= '</div></div>';
    }

    $html .= '</div>
        <div class="hobbies-box">
            <div class="title">
                <div class="box">
                    <h2>Hobbies</h2>
                </div>
            </div>';

    // Hobbies
    foreach ($hobbies as $hobby) {
        $html .= '<div class="d-flex align-items-center">
                    <div class="circle"></div>
                    <div><strong>' . ucwords($hobby) . '</strong></div>
                </div>';
    }

    $html .= '</div>
        </div>
        <!-- ZONE 2 -->
        <div class="zone-2">
            <div class="headTitle">
                <h1>' . ucwords($last_name) . '</h1>
            </div>
            <div class="subTitle">
                <h1>' . ucwords($location) . '</h1>
            </div>
            <div class="group-1">
                <div class="title">
                    <div class="box">
                        <h2>About Me</h2>
                    </div>
                    <p>' . ucwords($summary) . '</p>
                </div>
            </div>
            <div class="group-2">
                <div class="title">
                    <div class="box">
                        <h2>Education</h2>
                    </div>
                </div>
                <div class="desc">';

    // Education
    for ($i = 0; $i < count($institutes); $i++) {
        $html .= '<ul>
                    <li>
                        <div class="msg-1">' . $froms[$i] . '-' . $tos[$i] . ' | ' . ucwords($degrees[$i]) . ', ' . $grades[$i] . '</div>
                        <div class="msg-2">' . ucwords($institutes[$i]) . '</div>
                    </li>
                </ul>';
    }

    $html .= '</div>
        </div>
        <div class="group-3">
            <div class="title">
                <div class="box">
                    <h2>Experience</h2>
                </div>
            </div>
            <div class="desc">';

    // Experience
    for ($i = 0; $i < count($titles); $i++) {
        $html .= '<ul>
                    <li>
                        <div class="msg-1"><br></div>
                        <div class="msg-2">' . ucwords($titles[$i]) . '</div>
                        <div class="msg-3">' . ucfirst($descriptions[$i]) . '</div>
                    </li>
                </ul>';
    }

    $html .= '</div>
        </div>
    </div>
    </body>
    </html>';

    $doc->WriteHTML($html);
    $doc->Output('Document.pdf', 'D');

    // Redirect back to the form page with a success message
    wp_redirect(add_query_arg('cv_maker_success', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_cv_maker_form', 'cv_maker_handle_form_submission');
add_action('admin_post_nopriv_cv_maker_form', 'cv_maker_handle_form_submission');
