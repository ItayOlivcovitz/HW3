//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#ifndef COMPUTER_H
#define COMPUTER_H

#include "Item.h"
#include <string>
#include <iostream>

using std::string;
using std::to_string;

class Computer : public Item
{
private:
	string cpu ;
	bool isLaptop;

public:

	/**
	 * @brief Construct a new Computer object.
	 * 
	 * @param price - computer's price
	 * @param manufacturer - computer's brand
	 * @param cpu - computer's cpu brand
	 * @param isLaptop - is laptop / desktop
	 */
	Computer(const int price, const string& manufacturer, const string& cpu, const bool isLaptop);

	/**
	 * @brief Set computer's CPU.
	 * 
	 * @param cpu - cpu's brand
	 */
	void setCpu(const string& cpu);
	
	/**
	 * @brief Get computer's cpu
	 * 
	 * @return string - cpu's brand
	 */
	string getCpu() const;

	/**
	 * @brief Set if the computer is laptop ot not
	 * 
	 * @param isLaptop - True if laptop
	 */
	void setIsLaptop(const bool isLaptop);

	/**
	 * @brief Return true if the computer is laptop
	 * 
	 * @return true if laptop
	 * @return false if desktop
	 */
	bool getIsLaptop() const;

	/**
	 * @brief Return string representing the computer
	 * 
	 * @return string
	 */
	operator string() const override;

};

#endif /* COMPUTER_H */