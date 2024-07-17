pipeline {
    agent any

    stages {
        stage('Test Docker') {
            steps {
                script {
                    // Run a Docker command to check the Docker version
                    bat 'docker --version'
                }
            }
        }
    }
}
