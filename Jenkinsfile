pipeline {
  agent any
  environment {
    IMAGE_NAME  = 'limon408/bs23'
    IMAGE_TAG   = 'v2'
    APP_NAME    = 'bs23'
    // Note: DOCKERHUB_CREDENTIALS remains as is to be used in the script block
    DOCKERHUB_CREDENTIALS = credentials('dockerhub')
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
