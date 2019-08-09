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

        stage('TDD testing') {
            agent {
                docker {
                    image 'php:7.2-cli'
                }
            }
            steps {
                sh './vendor/bin/phpunit -c phpunit.xml --log-junit build/unit/junit.xml'
            }
            post {
                always {
                    junit 'build/**/junit.xml'
                }
            }
        }

        stage('Deploy to staging') {
            steps {
                build 'simple-php-docker-deploy'
            }
        }

        stage('BDD testing') {
            agent {
                label 'chromium-php72'
            }
            steps {
                sh 'composer install'
                sh './vendor/bin/behat -f pretty -o std -f junit -o build/reports/behat'
            }
            post {
                always {
                    junit 'build/reports/behat/*.xml'
                    archiveArtifacts artifacts: 'screenshots/*.png', fingerprint: true
                }
            }
        }
    }
}