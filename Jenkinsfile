pipeline {
    agent {
        docker {
            image 'node:20.15.1-alpine3.20'
        }
    }
    stages {
        stage('Build') {
            steps {
                sh 'node --version'
            }
        }
        stage('Test') {
            steps {
                sh 'npm test'
            }
        }
    }
}
