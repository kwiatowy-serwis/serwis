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
      cloverReportDir: 'reports/html/coverage',
      cloverReportFileName: 'index.html',
      healthyTarget: [methodCoverage: 70, conditionalCoverage: 70, statementCoverage: 70],
      unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50],
      failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
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

