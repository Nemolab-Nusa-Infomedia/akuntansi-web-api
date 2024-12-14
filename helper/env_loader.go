package helper

import (
	"log"
	"os"

	"github.com/joho/godotenv"
)

func LoadEnv() {
	requiredEnvVars := []string{
		"DB_URL",
		"PORT",
	}
	missingVars := []string{}

	err := godotenv.Load(".env")
	if err != nil {
		log.Println("No '.env' file found. Using environment variables directly.")
	} else {
		log.Println("Successfully loaded '.env' file")
	}

	for _, envVar := range requiredEnvVars {
		if os.Getenv(envVar) == "" {
			missingVars = append(missingVars, envVar)
		}
	}

	if len(missingVars) > 0 {
		log.Printf("Warning: The following required environment variables are not set: %v", missingVars)
		log.Println("Please ensure these variables are set in your environment or '.env' file.")
	} else {
		log.Println("All required environment variables are set.")
	}
}
