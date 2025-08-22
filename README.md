# Interview-Laravel-Rest-Api


## Table of Contents
1. [Project Setup]
2. [Models, Migrations, and Factories]
3. [Request Validation]
4. [Controllers]
5. [Resources]

---

## Step 1 (Project Setup):
**Create a new Laravel project:**
```bash
composer create-project laravel/laravel project-management-api
```

**Run Project**
```bash
- php artisan serve
```
## Step 2 (Models, Migrations, and Factories):

**1) create model with migration and factory**
- php artisan make:model Project -m -f
- php artisan make:model Task -m -f
- php artisan make:migration create_task_user_table --create=task_user


**2)Migration -> create tables**

**Run migrations to create the database tables**
```bash
 php artisan migrate

```

**4)create models**

**5)create factory**

**6)Seed the database using factories:**

```bash
php artisan migrate:fresh --seed

```
---

**6)Request Validation**
```bash
- php artisan make:request ProjectStoreRequest
- php artisan make:request ProjectUpdateRequest
- php artisan make:request TaskStoreRequest
- php artisan make:request TaskUpdateRequest
- php artisan make:request UserStoreRequest
- php artisan make:request UserUpdateRequest

```

**7)controller**
```bash
- php artisan make:controller ProjectController --api
- php artisan make:controller TaskController --api
- php artisan make:controller UserController --api
```

**8) Resources**
```bash
- php artisan make:resource ProjectResource
- php artisan make:resource TaskResource
- php artisan make:resource UserResource
```
--- 

### Notes:
- Soft Deletes are enabled for the Users model.
- Filtering, sorting, and pagination are implemented for Projects, Tasks, and Users.
- All Crud operations were tested in Postman and work correctly
- No authentication is required if not needed; CRUD operations can be tested directly.



---

## Created By

This project was created by **Alaa Abdullh**.
- LinkedIn: [https://www.linkedin.com/in/alaa-abdullh](https://www.linkedin.com/in/alaa-abdullh-3b050324b/)
