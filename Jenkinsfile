pipeline {
    agent none

    stages {
        stage('Composer install') {
            agent {
                docker {
                    image 'composer:latest'
                }
            }
            steps {
                sh 'composer install'
            }
        }

        stage('Run tests') {
            echo 'tests'
        }
    }
}