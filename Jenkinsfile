def remote = [:]
    remote.host = "${env.EC2_TEST}"
    remote.allowAnyHosts = true

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
                withCredentials([sshUserPrivateKey(credentialsId: 'chromium-php72', keyFileVariable: 'identity', passphraseVariable: '', usernameVariable: 'ubuntu')]) {
                    remote.user = userName
                    remote.identityFile = identity
                    sshScript remote: remote, script: 'deploy.sh'
                }
            }
        }
    }
}