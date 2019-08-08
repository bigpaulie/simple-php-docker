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

        stage('BDD testing') {
            steps {
                withDockerRegistry(url: 'registry.gitlab.com') {
                    withDockerContainer(args: '-v $PWD:/code -e DOCROOT=/code', image: 'dmore/docker-chrome-headless:7.1') {
                        sh 'vendor/bin/behat'
                    }
                }
            }
        }

        stage('Build docker image') {
            agent {
                label 'master'
            }
            steps {
                sh "docker build -t bigpaulie/simple-php-docker:${BUILD_NUMBER} ."
            }
            post {
                always {
                    echo "Don't really keep the image"
                    sh "docker image rm -f bigpaulie/simple-php-docker:${BUILD_NUMBER}"
                }
            }
        }
    }
}