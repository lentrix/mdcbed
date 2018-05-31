<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\User;
use app\models\Teacher;
use app\models\Student;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SeedController extends Controller
{
	public function actionUsersAndTeachers() {
		
		$data = [
			['username'=>'lentrix','fullName'=>'Benjie B. Lenteria', 'role'=>User::ROLE_ADMIN, 
				'lname'=>'Lenteria', 'fname'=>'Benjie','phone'=>'09173035716', 'specialization'=>'Information Technology'],
			['username'=>'teacher1','fullName'=>'Sample Teacher 1', 'role'=>User::ROLE_TEACHER, 
				'lname'=>'Teacher', 'fname'=>'Sample1','phone'=>'1234567', 'specialization'=>'Mathematics'],
			['username'=>'head1','fullName'=>'Sample Head 1', 'role'=>User::ROLE_HEAD, 
				'lname'=>'Head', 'fname'=>'Sample1','phone'=>'1234567', 'specialization'=>'English'],
			['username'=>'staff1','fullName'=>'Sample Staff 1', 'role'=>User::ROLE_STAFF, 
				'lname'=>'Staff', 'fname'=>'Sample','phone'=>'1234567', 'specialization'=>'Physical Education'],
		];

		foreach($data as $d) {
			echo "Seeding a user...\n";
			$teacherUser = new User;
			$teacherUser->username = $d['username'];
			$teacherUser->fullName = $d['fullName'];
			$teacherUser->role = $d['role'];
			$teacherUser->setPassword('password123');
			$teacherUser->save();

			echo "Seeding a teacher...\n";
			$teacher = new Teacher;
			$teacher->lastName = $d['lname'];
			$teacher->firstName = $d['fname'];
			$teacher->phone = $d['phone'];
			$teacher->specialization=$d['specialization'];
			$teacher->userId = $teacherUser->id;
			$teacher->save();

		}
	}

	public function actionStudents(){
		echo "Seeding students...\n";

		$studentsData = [
			['Doe','John','Smith','Pooc Occidental','Tubigon','Bohol', 'm','1988-11-02'],
			['dela Cruz', 'Juan','Tamad','Tinangnan','Tubigon','Bohol', 'm','1990-02-24'],
			['Reyes','Cristela','Jimenez', 'Ubojan','Inabanga', 'Bohol', 'f', '1991-04-08'],
			['Hamilton', 'Kevin Von','Lopez','Canamaya','Sagbayan','Bohol', 'm', '1993-09-22'],
			['Buenafe','Marife','Manisid','Cantomocad','Loon','Bohol', 'f','1989-02-02'],
			['Perez','Virgie','Mendez','Bonbon','Clarin','Bohol','f','1991-02-28'],
			['Melencion','Jonasita','Benavidez','Poblacion','Inabanga','Bohol','m', '1993-06-12'],
			['Udtohan','Marlon','Ramo','Buangan','Clarin','Bohol','m','1993-09-21'],
			['Yu','Ynochi','Tan','Bentig','Calape','Bohol','f','1992-10-22']
		];

		foreach($studentsData as $studentData) {
			$st = new Student;
			$st->lastName = $studentData[0];
			$st->firstName = $studentData[1];
			$st->middleName = $studentData[2];
			$st->barangay = $studentData[3];
			$st->town = $studentData[4];
			$st->province = $studentData[5];
			$st->gender = $studentData[6];
			$st->birthDate = $studentData[7];
			$st->save();
		}
	}

	public function actionDepartments()
	{
		echo "Seeding departments...\n";
		$depts = [
			['Pre', 'Pre-Elementary'],
			['Elem', 'Elementary'],
			['SHS','Senior High School'],
			['JHS','Junior High School']
		];
		foreach($depts as $dept) {
			$d = new \app\models\Department;
			$d->shortName = $dept[0];
			$d->longName = $dept[1];
			$d->save();
		}
	}

	public function actionVenues()
	{
		echo "Seeding venues...";

		$venues = [
			['St. Margarette',40],
			['Prudence',40],
			['Honesty',40],
			['St. Francis of Asisi',40],
			['St. John',40],
			['Integrity',40]
		];

		foreach($venues as $venue) {
			$v = new \app\models\Venue;
			$v->name = $venue[0];
			$v->capacity = $venue[1];
			$v->save();
		}
	}

	public function actionLevels() {
		echo "Removing levels.. ";
        $this->clearLevels();
        echo "Done.\n";

        echo "Seeding new levels.. ";
        $levels = [
	    ['N', 'Nursery', 'presc'],
            ['K1', 'Kindergarten 1', 'presc'],
            ['K2' , 'Kindergarten 2', 'presc'],
            ['Gr1', 'Grade 1', 'elem'],
            ['Gr2', 'Grade 2', 'elem'],
            ['Gr3', 'Grade 3', 'elem'],
            ['Gr4', 'Grade 4', 'elem'],
            ['Gr5', 'Grade 5', 'elem'],
            ['Gr6', 'Grade 6', 'elem'],
            ['Gr7', 'Grade 7', 'jhs'],
            ['Gr8', 'Grade 8', 'jhs'],
            ['Gr9', 'Grade 9', 'jhs'],
            ['Gr10', 'Grade 10', 'jhs'],
            ['Gr11', 'Grade 11', 'shs'],
            ['Gr12', 'Grade 12', 'shs'],
            ['Bacc1', '1st Year College','clg'],
            ['Bacc2', '2nd Year College','clg'],
            ['Bacc3', '3rd Year College','clg'],
            ['Bacc4', '4th Year College','clg'],
            ['Bacc5', '5th Year College','clg'],
            ['Grad', 'Graduate School', 'grad']
        ];

        $size = count($levels);

        foreach($levels as $i=>$level) {
            Yii::$app->db->CreateCommand()->insert('level',[
                'shortName'=>$level[0],
                'longName'=>$level[1],
                'category'=>$level[2],
                'nextLevelId' => $i==($size-1)?null:$i+1,
                'previousLevelId' => $i==0?null:$i-1,
            ])->execute();
        }

        echo "Done.\n";
	}

	private function clearLevels()
    {
        Yii::$app->db->createCommand("DELETE FROM level")->execute();
    }

    public function actionPeriods()
    {
    	echo "Seeding periods...\n";
    	$data = [
    		['SY1718','School Year 2017-2018', '2017-06-13','2018-03-23',0,false],
    		['2T1718', '2nd Semester AY 2017-2018', '2017-11-05','2018-03-23',1,false],
    		['3T18','Summer 2018','2018-04-09','2018-05-23',1,false],
    		['SY1819', 'School Year 2018-2019','2018-06-18','2019-03-23',0,true],
    		['1T1819', '1st Semester AY 2018-2019', '2018-06-18','2018-10-23',1,true]
    	];

    	foreach($data as $d) {
    		$p = new \app\models\Period;
    		$p->shortName = $d[0];
    		$p->longName = $d[1];
    		$p->start = $d[2];
    		$p->end = $d[3];
    		$p->type = $d[4];
    		$p->active = $d[5];
    		$p->save();
    	}
    }

	public function actionAll() {
		$this->actionLevels();
		$this->actionUsersAndTeachers();
		$this->actionStudents();
		$this->actionDepartments();
		$this->actionVenues();
		$this->actionPeriods();
	}
}