pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
        git(url: 'https://github.com/dframe/dframe', branch: 'master')
        sh '''sh \'composer install\'
'''
        sh 'sh \'composer require phpunit/phpunit\''
        sh 'sh \'vendor/bin/phpunit\''
      }
    }
  }
  environment {
    HTTP_HOST = 'dframeframework.com'
    MOD_REWRITE = 'true'
  }
}