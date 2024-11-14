<template>
    <v-container>
        <v-row>
            <v-col cols="3">
                <h3>Your Courses</h3>
                <v-list>
                    <v-list-item 
                        v-for="course in courses" 
                        :key="course.id" 
                        @click="selectCourse(course)"
                        :class="{'selected-course': selectedCourse && selectedCourse.id === course.id}"
                    >
                        <v-list-item-title>{{ course.name }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-col>

            <v-col cols="6">
                <div v-if="!isRegistered">
                    <h3>{{ selectedCourse?.name }}</h3>
                    <p>{{ selectedCourse?.description }}</p>
                    <v-btn color="primary" @click="registerToCourse">Register</v-btn>
                </div>
                <div v-else>
                    <h3>{{ selectedCourse?.name }}</h3>
                    <v-card v-if="currentVideo">
                        <v-card-title>{{ currentVideo.title }}</v-card-title>
                        <iframe :src="currentVideo.url" width="100%" height="400px"></iframe>
                        <v-card-actions>
                            <v-btn color="secondary" @click="likeVideo(currentVideo.id)">Like</v-btn>
                            <v-btn v-if="nextVideo" @click="goToNextVideo">Next Video</v-btn>
                        </v-card-actions>
                        <div>
                            <textarea v-model="newComment" placeholder="Add a comment"></textarea>
                            <v-btn color="primary" @click="addComment(currentVideo.id)">Submit Comment</v-btn>
                        </div>
                    </v-card>
                </div>
            </v-col>

            <v-col cols="3">
                <h3>Course Videos</h3>
                <v-list>
                    <v-list-item
                        v-for="video in courseVideos"
                        :key="video.id"
                        @click="selectVideo(video)"
                        :class="{'completed-video': video.completed}"
                    >
                        <v-list-item-title>{{ video.title }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { CourseService } from '@/services/CourseService';
import { UserService } from '@/services/UserService';

export default {
    setup() {
        const courses = ref([]);
        const courseVideos = ref([]);
        const selectedCourse = ref(null);
        const currentVideo = ref(null);
        const nextVideo = ref(null);
        const isRegistered = ref(false);
        const newComment = ref("");

        const loadCourses = async () => {
            const response = await CourseService.getCourses();
            courses.value = response.data;
        };

        const selectCourse = async (course) => {
            selectedCourse.value = course;
            const progressResponse = await CourseService.getCourseProgress(course.id);
            isRegistered.value = progressResponse.data.is_registered;

            if (isRegistered.value) {
                loadCourseVideos(course.id);
            }
        };

        const registerToCourse = async () => {
            await UserService.registerToCourse(selectedCourse.value.id);
            isRegistered.value = true;
            loadCourseVideos(selectedCourse.value.id);
        };

        const loadCourseVideos = async (courseId) => {
            const response = await CourseService.getCourseVideos(courseId);
            courseVideos.value = response.data.videos;

            // Set initial video and next video
            const currentIndex = courseVideos.value.findIndex(video => !video.completed);
            currentVideo.value = courseVideos.value[currentIndex];
            nextVideo.value = courseVideos.value[currentIndex + 1] || null;
        };

        const selectVideo = (video) => {
            if (video.completed || video === currentVideo.value || video === nextVideo.value) {
                currentVideo.value = video;
            }
        };

        const goToNextVideo = async () => {
            await CourseService.updateProgress(currentVideo.value.id);
            currentVideo.value.completed = true;
            currentVideo.value = nextVideo.value;

            const currentIndex = courseVideos.value.findIndex(video => video.id === currentVideo.value.id);
            nextVideo.value = courseVideos.value[currentIndex + 1] || null;
        };

        const addComment = async (videoId) => {
            await CourseService.addComment(videoId, { text: newComment.value });
            newComment.value = "";
        };

        const likeVideo = async (videoId) => {
            await CourseService.likeVideo(videoId);
        };

        onMounted(() => {
            loadCourses();
        });

        watch(selectedCourse, async () => {
            if (selectedCourse.value) {
                await selectCourse(selectedCourse.value);
            }
        });

        return {
            courses,
            courseVideos,
            selectedCourse,
            currentVideo,
            nextVideo,
            isRegistered,
            newComment,
            loadCourses,
            selectCourse,
            registerToCourse,
            loadCourseVideos,
            selectVideo,
            goToNextVideo,
            addComment,
            likeVideo
        };
    }
};
</script>

<style scoped>
.selected-course {
    font-weight: bold;
}

.completed-video {
    text-decoration: line-through;
}

textarea {
    width: 100%;
    height: 100px;
    margin-top: 10px;
    padding: 8px;
}
</style>
