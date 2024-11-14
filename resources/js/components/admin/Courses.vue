<template>
  <v-container>
    <v-row class="justify-center">
      <v-col cols="12" md="8">
        <h2 class="text-center">Courses List</h2>
        <v-alert v-if="courses.length === 0" type="info" class="mt-4">
          No courses available.
        </v-alert>

        <v-list>
          <v-list-item-group>
            <v-list-item v-for="course in courses" :key="course.id" class="mb-4">
              <v-card elevation="2">
                <v-card-title class="headline">{{ course.name }}</v-card-title>
                <v-card-subtitle>{{ course.description }}</v-card-subtitle>
                <v-card-actions>
                  <v-btn :href="`/admin/courses/${course.id}`" color="info" text>View Details</v-btn>
                  <v-btn :href="`/admin/courses/${course.id}/videos`" color="primary" text>Manage Videos</v-btn>
                </v-card-actions>
              </v-card>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { ref, onMounted } from 'vue';
import { CourseService } from '@/services/CourseService';

export default {
  setup() {
    const courses = ref([]);

    const loadCourses = async () => {
      try {
        const response = await CourseService.getCourses();
        courses.value = response.data;
      } catch (error) {
        console.error("There was an error fetching the courses:", error);
      }
    };

    onMounted(() => {
      loadCourses();
    });

    return { courses };
  }
};
</script>

<style scoped>
.text-center {
  text-align: center;
}
</style>
