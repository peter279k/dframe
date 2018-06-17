#!/usr/bin/env groovy

node('master') {
    try {
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
    } catch(error) {
        throw error
    } finally {

    }

}
