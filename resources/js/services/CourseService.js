import axios from 'axios';

const API_URL = '/api/courses';

export const CourseService = {
  getCourses() {
    return axios.get(API_URL);
  },
  getCourseVideos(courseId) {
    return axios.get(`${API_URL}/${courseId}/videos`);
  },
  createCourseVideo(courseId, videoData) {
    return axios.post(`/admin/courses/${courseId}/videos`, videoData);
  },
  deleteCourseVideo(videoId) {
    return axios.delete(`/admin/courses/videos/${videoId}`);
  },
  registerToCourse(courseId) {
    return axios.post(`${API_URL}/courses/${courseId}/register`);
  },
};
