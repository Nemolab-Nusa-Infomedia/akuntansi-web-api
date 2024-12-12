package web

type SuccessResponse struct {
	Status  int         `json:"status" example:"200"`
	Message string      `json:"message" example:"Success message"`
	Data    interface{} `json:"data"`
}

type ErrorResponse struct {
	Status  int         `json:"status" example:"400"`
	Message string      `json:"message" example:"Failed message"`
	Error   interface{} `json:"error"`
}
