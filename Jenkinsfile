pipeline {
  agent any
  stages {
    stage('build') {
        checkout scm
        sh "composer install"
    }
      
    stage('test') {
        sh "./vendor/bin/phpunit"
    }

    stage('deploy') {
       sh "echo 'WE ARE DEPLOYING'"
    }
  }
  environment {
    HTTP_HOST = 'dframeframework.com'
    MOD_REWRITE = 'true'
  }
}
