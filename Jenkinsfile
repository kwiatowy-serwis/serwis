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
		sh './vendor/bin/phpunit --log-junit reports/xunit --coverage-php reports/coverage --coverage-clover reports/coverage';
	}
	
	stage('xunit'){
		junit 'reports/xunit';
	}

	stage('coverage'){
		step([
		 $class: 'CloverPublisher',
		 cloverReportDir: 'reports',
		 cloverReportFileName: 'coverage',
		 healthyTarget: [methodCoverage: 10, conditionalCoverage: 10, statementCoverage: 10],
		 unhealthyTarget: [methodCoverage: 5, conditionalCoverage: 5, statementCoverage: 5],
		 failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
			])
	}

	stage('deploy') {
		    sh 'sudo rm -fr /home/student/projekty/serwis/*'
			sh 'sudo cp -ar ./. /home/student/projekty/serwis'
			sh 'sudo chmod -R 777 /home/student/projekty/serwis'
}

	stage('laravel migrations'){
		sh 'cd /home/student/projekty/laradock && sudo docker-compose exec -T --user=laradock workspace /var/www/serwis/artisan migrate:refresh'

	}
}

