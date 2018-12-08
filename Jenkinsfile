node('master'){
	stage('checkout'){
		checkout scm
	}

	stage('build'){
		sh 'composer install'
	}
	
	  stage('create-env-keys'){
                sh 'php artisan key:generate';
        }

	stage('test'){
		sh './vendor/bin/phpunit --log-junit reports/xunit --coverage-html reports/html/coverage --coverage-clover reports/coverage';
	}
	
	stage('xunit'){
		junit 'reports/xunit';
	}

    step([
      $class: 'CloverPublisher',
      cloverReportDir: 'target/site',
      cloverReportFileName: 'clover.xml',
      healthyTarget: [methodCoverage: 70, conditionalCoverage: 70, statementCoverage: 70], // optional, default is: method=70, conditional=80, statement=80
      unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50], // optional, default is none
      failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]     // optional, default is none
    ])
    
	stage('deploy') {
		    sh 'sudo rm -fr /home/student/projekty/serwis/*'
			sh 'sudo cp -ar ./. /home/student/projekty/serwis'
			sh 'sudo chmod -R 777 /home/student/projekty/serwis'
}

	stage('laravel migrations'){
		sh 'cd /home/student/projekty/laradock && sudo docker-compose exec -T --user=laradock workspace /var/www/serwis/artisan migrate:refresh'

	}
}

