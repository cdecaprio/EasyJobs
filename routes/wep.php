<!-- 
 git add remote origin https://github.com/juanpabon/sistema-de-clases.git
 git push origin main
artisan migrate:fresh --seed
 artisan db:seed
artisan migrate
artisan make migration nombre de la tabla
artisan make:migration add_course_id_to_users
artisan make:model -mc nombre del modelo 

1.artisan make:seed CourseSeeder
2. al arxiu importar el modelo
function run();
$courses = [
    ['name' => 'Matemáticas'],
    ['name' => 'Programación'],
    ['name' => 'Base de datos'],
];
foreach ($courses as $name) {
    Course::updateOrCreate(['name' => $name]);
}
3.en el database seeder.php
dentro de la funcion run()
$this->call([
    CourseSeeder::class,
]);
y el artisan db:seed
















-->
