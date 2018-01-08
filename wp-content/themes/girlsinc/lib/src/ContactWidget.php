<?php

namespace GirlsInc\MarcUSA;

class ContactWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('marcusa_girls_inc_contact', 'Girls Inc Contact');
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="contact-widget">
            <p class="text-primary contact-name"><?= $instance['name'] ?></p>
            <p class="contact-title"><?= $instance['title'] ?></p>
            <p class="contact-phone"><i class="fa fa-phone" aria-hidden="true"></i><?= $instance['phone'] ?></p>
            <p class="contact-email"><i class="fa fa-envelope" aria-hidden="true"></i><?= $instance['email'] ?></p>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $defaults = [
            'name' => '',
            'title' => '',
            'phone' => '',
            'email' => '',
        ];

        $instance = wp_parse_args((array)$instance, $defaults);
        ?>
        <p>
            <label for="<?= $this->get_field_id('name'); ?>">Name:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>"
                   name="<?= $this->get_field_name('name'); ?>" type="text"
                   value="<?= esc_attr($instance['name']); ?>"/>
        </p>
        <p>
            <label for="<?= $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?= $this->get_field_name('title'); ?>" type="text"
                   value="<?= esc_attr($instance['title']); ?>"/>
        </p>
        <p>
            <label for="<?= $this->get_field_id('phone'); ?>">Phone:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>"
                   name="<?= $this->get_field_name('phone'); ?>" type="text"
                   value="<?= esc_attr($instance['phone']); ?>"/>
        </p>
        <p>
            <label for="<?= $this->get_field_id('email'); ?>">Email:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>"
                   name="<?= $this->get_field_name('email'); ?>" type="text"
                   value="<?= esc_attr($instance['email']); ?>"/>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}