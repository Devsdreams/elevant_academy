<?php
    $instructor_id = $this->session->userdata('user_id');
    $number_of_courses = $this->crud_model->get_instructor_wise_courses($instructor_id)->num_rows();
?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title d-flex align-items-center">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> 
                    <?php echo get_phrase('courses'); ?>
                </h4>
                <div class="d-flex justify-content-end align-items-center mt-3 position-relative">
                    <?php if ($number_of_courses == 0): ?>
                        <div class="floating-notification d-flex align-items-center" id="floating-notification">
                            <?php echo get_phrase('comencemos_a_crear_tu_primer_curso'); ?>
                            <div class="arrow"></div>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo site_url('user/course_form/add_course'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle ml-3" id="add-course-button">
                        <i class="mdi mdi-plus"></i><?php echo get_phrase('add_new_course'); ?>
                    </a>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<style>
    /* Estilo para la notificación flotante */
    .floating-notification {
        background-color: #727cf5;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        margin-right: 0px; /* Sin margen derecho */
        margin-top: 35px; /* Ajuste vertical */
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: bounce 1.5s infinite;
    }

    /* Flecha que apunta al botón */
    .floating-notification .arrow {
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid #727cf5;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }

    /* Animación de rebote */
    @keyframes bounce {
        0%, 100% {
            transform: translateY(-50%) translateX(0);
        }
        50% {
            transform: translateY(-50%) translateX(-5px);
        }
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-link text-muted" style="font-size: 24px;"></i>
                                    <h3><span>
                                        <?php
                                            $active_courses = $this->crud_model->get_status_wise_courses_for_instructor('active');
                                            echo $active_courses->num_rows();
                                         ?>
                                    </span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('active_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-link-broken text-muted" style="font-size: 24px;"></i>
                                    <h3><span>
                                        <?php
                                            $pending_courses = $this->crud_model->get_status_wise_courses_for_instructor('pending');
                                            echo $pending_courses->num_rows();
                                         ?>
                                    </span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('pending_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-bookmark text-muted" style="font-size: 24px;"></i>
                                    <h3><span>
                                        <?php
                                            $draft_courses = $this->crud_model->get_status_wise_courses_for_instructor('draft');
                                            echo $draft_courses->num_rows();
                                         ?>
                                    </span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('draft_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-star text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $this->crud_model->get_free_and_paid_courses('free', $this->session->userdata('user_id'))->num_rows(); ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('free_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-tags text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $this->crud_model->get_free_and_paid_courses('paid', $this->session->userdata('user_id'))->num_rows(); ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('paid_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('course_list'); ?></h4>
                <form class="row justify-content-center" action="<?php echo site_url('user/courses'); ?>" method="get">
                    <!-- Course Categories -->
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="category_id"><?php echo get_phrase('categories'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="category_id" id="category_id">
                                <option value="<?php echo 'all'; ?>" <?php if($selected_category_id == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                                <?php foreach ($categories->result_array() as $category): ?>
                                    <optgroup label="<?php echo $category['name']; ?>">
                                        <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                        foreach ($sub_categories as $sub_category): ?>
                                        <option value="<?php echo $sub_category['id']; ?>" <?php if($selected_category_id == $sub_category['id']) echo 'selected'; ?>><?php echo $sub_category['name']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Course Status -->
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="status"><?php echo get_phrase('status'); ?></label>
                        <select class="form-control select2" data-toggle="select2" name="status" id = 'status'>
                            <option value="all" <?php if($selected_status == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                            <option value="active" <?php if($selected_status == 'active') echo 'selected'; ?>><?php echo get_phrase('active'); ?></option>
                            <option value="pending" <?php if($selected_status == 'pending') echo 'selected'; ?>><?php echo get_phrase('pending'); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Course Price -->
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="price"><?php echo get_phrase('price'); ?></label>
                        <select class="form-control select2" data-toggle="select2" name="price" id = 'price'>
                            <option value="all"  <?php if($selected_price == 'all' ) echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                            <option value="free" <?php if($selected_price == 'free') echo 'selected'; ?>><?php echo get_phrase('free'); ?></option>
                            <option value="paid" <?php if($selected_price == 'paid') echo 'selected'; ?>><?php echo get_phrase('paid'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-3">
                    <label for=".." class="text-white">..</label>
                    <button type="submit" class="btn btn-primary btn-block" name="button"><?php echo get_phrase('filter'); ?></button>
                </div>
            </form>

            <div class="table-responsive-sm mt-4">
                <?php if (count($courses) > 0): ?>
                    <table id="course-datatable-server-side" class="table table-striped dt-responsive nowrap" width="100%" data-page-length='25'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('title'); ?></th>
                                <th><?php echo get_phrase('category'); ?></th>
                                <th><?php echo get_phrase('lesson_and_section'); ?></th>
                                <th><?php echo get_phrase('enrolled_student'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('instructor_earning'); ?></th> <!-- Nueva columna -->
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $instructor_revenue_percentage = $this->db->get_where('settings', ['key' => 'instructor_revenue'])->row()->value; // Obtener el porcentaje de ganancia
                            foreach ($courses as $key => $course):
                                $course_price = $course['is_free_course'] == 1 ? 0 : ($course['discount_flag'] == 1 ? $course['discounted_price'] : $course['price']);
                                $instructor_earning = ($course_price * $instructor_revenue_percentage) / 100; // Calcular ganancia

                                // Generar acciones
                                $view_course_on_frontend_url = site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']);
                                $edit_course_url = site_url('user/course_form/course_edit/' . $course['id']);
                                $delete_course_url = "confirm_modal('" . site_url('user/course_actions/delete/' . $course['id']) . "')";
                                $publish_course_url = "confirm_modal('" . site_url('user/course_actions/publish/' . $course['id']) . "')";
                                $draft_course_url = "confirm_modal('" . site_url('user/course_actions/draft/' . $course['id']) . "')";

                                $actions = '
                                <div class="dropright dropright">
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="' . $view_course_on_frontend_url . '" target="_blank">' . get_phrase('view_course_on_frontend') . '</a></li>
                                        <li><a class="dropdown-item" href="' . $edit_course_url . '">' . get_phrase('edit_this_course') . '</a></li>';
                                if ($course['status'] == 'active' || $course['status'] == 'pending') {
                                    $actions .= '<li><a class="dropdown-item" href="javascript:;" onclick="' . $draft_course_url . '">' . get_phrase('mark_as_drafted') . '</a></li>';
                                } else {
                                    $actions .= '<li><a class="dropdown-item" href="javascript:;" onclick="' . $publish_course_url . '">' . get_phrase('publish_this_course') . '</a></li>';
                                }
                                $actions .= '<li><a class="dropdown-item" href="javascript:;" onclick="' . $delete_course_url . '">' . get_phrase('delete_this_course') . '</a></li>
                                    </ul>
                                </div>';
                            ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo $course['title']; ?></td>
                                    <td><?php echo $course['category']; ?></td>
                                    <td><?php echo $course['lesson_and_section']; ?></td>
                                    <td><?php echo $course['enrolled_student']; ?></td>
                                    <td><?php echo $course['status']; ?></td>
                                    <td><?php echo currency($course_price); ?></td>
                                    <td><?php echo currency($instructor_earning); ?></td>
                                    <td><?php echo $actions; ?></td> <!-- Mostrar acciones -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php if (count($courses) == 0): ?>
                    <div class="img-fluid w-100 text-center">
                      <img style="opacity: 1; width: 100px;" src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                      <?php echo get_phrase('no_data_found'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
