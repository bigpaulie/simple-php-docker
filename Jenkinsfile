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
            agent {
                docker {
                    image 'phpunit/phpunit'
                }
            }
            steps {
                sh 'phpunit -c phpunit.xml --log-junit build/unit/junit.xml'
                post {
                    always {
                        junit 'build/**/junit.xml'
                    }
                }
            }
        }
    }
}