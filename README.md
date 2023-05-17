# EDM_TASK_DEMO

Laravel version: 8.75
Livewire version: 2.5

Database Name: laravel_edm_exam
DB Username: edm_exam_username
DB Password: edm_exam_password!

## Installation Step:

# create table

php artisan migrate

# install jetstream & livewire

composer require laravel/jetstream
php artisan jetstream:install livewire

## Then

Can test the function.
First to go root page. /
Here is a form element for insert requirement(Loan amount, Annual interest rate, Loan term & Monthly fixed extra payment),
Once your requirement submitted, the screen will scroll to the schedule section to display loan result.

Beside that, The nav's List tab would bring you to the loan requirement list that submitted before.
There can find out all loan requirement, Click "Detail" to see more information;
Or Click "Update" to go to form section and submit a new form again.

# Finish, Enjoy!
