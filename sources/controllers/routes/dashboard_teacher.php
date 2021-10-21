<?php

    function dashboard_teacher () {

        render_role('dashboard_teacher', [
            'title' => 'Dashboard',
            'active' => 1
        ]);
    }