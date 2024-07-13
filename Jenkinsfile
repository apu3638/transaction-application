pipeline {
  agent any
  environment {
    IMAGE_NAME  = 'bs23'
    IMAGE_TAG   = 'v1'
    APP_NAME    = 'bs23'
    DOCKERHUB_CREDENTIALS = credentials('dockerhub') // Jenkins credentials ID for Docker Hub
  }
  stages {
     stage('Checkout') {
         steps {
             // Checkout the repository
             git url: 'https://github.com/limonbat/transaction-application.git', branch: 'main'
         }
     }
     stage('Install Dependencies') {
         steps {
             // Install PHP dependencies
             sh 'composer install'
             // Generate application key
             sh 'php artisan key:generate'
         }
     }
  }
  post {
    success {
        echo 'Pipeline succeeded!'
    }
    failure {
        echo 'Pipeline failed!'
    }
  }
}
