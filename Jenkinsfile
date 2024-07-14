pipeline {
  agent any
  environment {
    IMAGE_NAME = 'limon408/bs23'
    IMAGE_TAG = 'v2'
    APP_NAME = 'bs23'
    DOCKERHUB_CREDENTIALS = credentials('dockerhub')
  }
  stages {
    stage('Checkout') {
      steps {
        git url: 'https://github.com/limonbat/transaction-application.git', branch: 'main'
      }
    }
    stage('Install Dependencies') {
      steps {
        sh 'composer install'
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
