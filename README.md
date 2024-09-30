# Student, Courses, and Instructors Management System (API)

## Overview
This project is an API for managing students, courses, and instructors. The system allows the registration of students, assigning them to multiple courses, and provides functionalities for managing courses and instructors. The main goal is to facilitate effective tracking of student enrollments and course management within a training system.

## Features

1. **Add New Students**  
   - Allows adding new students with essential information (name, email, etc.).
   - Students can enroll in multiple courses.

2. **Course Management**  
   - Add, view, and manage courses.
   - Each course is taught by one instructor.
   - Each course can have multiple students enrolled.

3. **Instructor Management**  
   - Instructors can be assigned to multiple courses.
   - The system provides functionality to list all courses taught by a specific instructor.

4. **Relationships**  
   - Students can enroll in multiple courses.
   - Courses can have multiple students.
   - Instructors can teach multiple courses.
   - `hasManyThrough` to show all students learning from a specific instructor.

   ### Steps to Run the System


- [Installation](#installation)
 1. **Clone the repository:**
 
     ```bash
     git clone https://github.com/HusseinIte/CoursesManagementSystem.git
     cd CoursesManagementSystem
     ```
 
 2. **Install dependencies:**
 
     ```bash
     composer install
     npm install
     ```
 
 3. **Copy the `.env` file:**
 
     ```bash
     cp .env.example .env
     ```
 
 4. **Generate an application key:**
 
     ```bash
     php artisan key:generate
     ```
 
 5. **Configure the database:**
 
     Update your `.env` file with your database credentials.
 
 6. **Run the migrations:**
 
     ```bash
     php artisan migrate --seed
     ```
 7. **Run the seeders (Optional):**
 
     If you want to populate the database with sample data, use the seeder command:
 
     ```bash
     php artisan db:seed
     ```
 8. **Serve the application:**
 
     ```bash
     php artisan serve
     ```
