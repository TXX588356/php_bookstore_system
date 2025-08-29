## Database Setup

Follow these steps to set up the database for the project:

1. **Create Database**  
   - Use phpMyAdmin to create a new database for the project.  
   - Update the `.env` file in the project root to configure the database name, username, and password.

2. **Run Migrations**  
   - Open a terminal or command prompt in the project folder.  
   - Run the following command to create the necessary tables:
     ```bash
     php artisan migrate
     ```

3. **Seed the Database**  
   - Populate the tables with initial data using the following command:
     ```bash
     php artisan db:seed
     ```
   - This will insert sample data to help you start running the website immediately.
