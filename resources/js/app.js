import './bootstrap';

import { createApp } from 'vue';

// Vuetify
import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

import Home from './components/Home.vue';
import AdminSite from './components/admin/Home.vue';
import Courses from './components/admin/Courses.vue';
import Course from './components/admin/Course.vue';
import CourseCreate from './components/admin/CourseCreate.vue';
import VideoManager from './components/admin/VideoManager.vue';
import UserSite from './components/User/Home.vue';
import UserCourses from './components/User/UserCourses.vue';

const vuetify = createVuetify({
    components,
    directives
});

createApp({
    components: {
        Home,
        AdminSite,
        UserSite,
        Courses,
        Course,
        CourseCreate,
        VideoManager,
        UserCourses
    }
})
.use(vuetify)
.mount('#app');